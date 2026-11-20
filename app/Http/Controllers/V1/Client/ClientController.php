<?php

namespace App\Http\Controllers\V1\Client;

use App\Http\Controllers\Controller;
use App\Protocols\Clash;
use App\Protocols\ClashMeta;
use App\Protocols\ClashNyanpasu;
use App\Protocols\ClashVerge;
use App\Protocols\General;
use App\Protocols\NextinEncrypted;
use App\Protocols\Singbox\Singbox;
use App\Protocols\Singbox\SingboxOld;
use App\Services\InsiderGuardService;
use App\Services\ServerService;
use App\Services\SubscribeEncryptService;
use App\Services\UserService;
use App\Utils\Helper;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    // 标记本次响应是否已由 NextinEncrypted 通道处理，避免叠加订阅加密
    private $nextinHandled = false;

    public function subscribe(Request $request)
    {
        $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? '';
        $response = $this->buildSubscribe($request, $userAgent);
        if ($this->nextinHandled) {
            return $response;
        }
        return SubscribeEncryptService::encryptResponse($response, $request->user, $userAgent, (string)$request->header('X-IV', ''));
    }

    private function buildSubscribe(Request $request, $userAgent)
    {
        $explicitFlag = $request->input('flag');
        $flag = strtolower($explicitFlag ?? $userAgent);
        // 显式 flag 参数沿用 sing 匹配；UA 只认 sing-box / singbox，不再按 sing 子串匹配
        $isSingBox = $explicitFlag !== null
            ? strpos($flag, 'sing') !== false
            : preg_match('/sing[-_ ]?box/', $flag) === 1;
        $user = $request->user;
        // account not expired and is not banned.
        $userService = new UserService();
        if ($userService->isAvailable($user)) {
            $serverService = new ServerService();
            $servers = $serverService->getAvailableServers($user);
            // 被 Nextin 规则拦截的 UA 什么都拿不到，不算一次下发，提前返回
            if ($flag && NextinEncrypted::shouldBlockSubscriptionForUserAgent($userAgent)) {
                return response('', 403);
            }
            // 风控中心限制的用户：节点照常下发，入口地址换成假的；放在域名重写之前，重写规则不会再把真实地址带回来
            $decoy = InsiderGuardService::isRestricted((int)$user->id);
            if ($decoy) InsiderGuardService::applyDecoy($servers, (int)$user->id);
            $this->applyDomainRewriteRules($servers, $flag);
            $this->applyNodeWhitelistRules($servers, $flag);
            InsiderGuardService::recordSubscribe($user, $request, $servers, $decoy);
            $protocol = null;
            $version = null;
            if ($flag) {
                $shouldReturnEncryptedClashMeta =
                    NextinEncrypted::shouldEncryptForUserAgent($userAgent)
                    || strpos($flag, get_class_vars(NextinEncrypted::class)['flag']) !== false;

                if ($shouldReturnEncryptedClashMeta || !$isSingBox) {
                    $this->setSubscribeInfoToServers($servers, $user);
                }

                if ($shouldReturnEncryptedClashMeta) {
                    $this->nextinHandled = true;
                    $protocol = NextinEncrypted::class;
                } elseif (!$isSingBox) {
                    foreach (array_reverse(glob(app_path('Protocols') . '/*.php')) as $file) {
                        $file = 'App\\Protocols\\' . basename($file, '.php');
                        if (strpos($flag, get_class_vars($file)['flag']) !== false) {
                            $protocol = $file;
                            break;
                        }
                    }
                } else {
                    // 保留预发布后缀（1.13.0-beta.2），后续按版本下发新字段时才不会把预发布版当成正式版
                    if (preg_match('/sing-box\s+([0-9]+(?:\.[0-9]+)*(?:-[0-9A-Za-z.]+)?)/i', $flag, $matches)) {
                        $version = $matches[1];
                    }
                    if (!is_null($version) && $version >= '1.12.0') {
                        $protocol = Singbox::class;
                    } else {
                        $protocol = SingboxOld::class;
                    }
                }
            }

            $this->applySelfSignedFallback($servers, $protocol, $version);

            if ($protocol === Singbox::class) {
                return (new Singbox($user, $servers, ['version' => $version]))->handle();
            }
            $protocol = $protocol ?? General::class;
            return (new $protocol($user, $servers))->handle();
        }
    }

    /**
     * 上游做法：Clash 系、sing-box 订阅里「自签名（面板下发）」证书的 v2node 节点改成允许不安全，否则连不上。
     * 本仓库能给客户端下发证书固定的（mihomo 的 fingerprint、sing-box 1.13+ 的公钥固定）保持原样，pin 照常校验；
     * NextinEncrypted 的客户端不读 fingerprint，按上游做法处理
     */
    private function applySelfSignedFallback(array &$servers, ?string $protocol, ?string $version)
    {
        if (!in_array($protocol, [
            Clash::class, ClashMeta::class, ClashNyanpasu::class, ClashVerge::class, NextinEncrypted::class,
            Singbox::class, SingboxOld::class,
        ], true)) {
            return;
        }
        foreach ($servers as $key => $server) {
            if ($server['type'] !== 'v2node' || (int)$server['tls'] !== 1
                || ($server['tls_settings']['cert_mode'] ?? null) !== 'remote') {
                continue;
            }
            if (in_array($protocol, [ClashMeta::class, ClashNyanpasu::class, ClashVerge::class], true)
                && Helper::clientPinSha256($server) !== '') {
                continue;
            }
            if ($protocol === Singbox::class && version_compare($version, '1.13.0', '>=')
                && Helper::pinnedPublicKeySha256($server) !== '') {
                continue;
            }
            $servers[$key]['tls_settings']['allow_insecure'] = 1;
            if ($server['protocol'] === 'vmess') {
                // Clash Meta's VMess builders read the legacy spelling.
                $servers[$key]['tls_settings']['allowInsecure'] = 1;
            }
        }
    }

    private function applyDomainRewriteRules(&$servers, $ua)
    {
        $rules = config('v2board.subscribe_domain_rewrite_rules', []);
        if (empty($rules) || empty($ua)) return;

        $matchedRules = [];
        foreach ($rules as $rule) {
            if (empty($rule['ua']) || empty($rule['domain']) || empty($rule['ip'])) continue;
            $uas = preg_split('/[,，|;；\n\r]+/u', (string)$rule['ua'], -1, PREG_SPLIT_NO_EMPTY);
            $matched = false;
            foreach ($uas as $targetUa) {
                $targetUa = trim($targetUa);
                if ($targetUa === '') continue;
                if ($targetUa === '*' || stripos($ua, $targetUa) !== false) {
                    $matched = true;
                    break;
                }
            }
            if ($matched) {
                $matchedRules[] = $rule;
            }
        }
        if (empty($matchedRules)) return;

        $addressFields = ['host', 'server', 'address'];
        foreach ($servers as &$server) {
            foreach ($matchedRules as $rule) {
                foreach ($addressFields as $field) {
                    if (isset($server[$field]) && strtolower($server[$field]) === strtolower($rule['domain'])) {
                        $server[$field] = $rule['ip'];
                    }
                }
            }
        }
        unset($server);
    }

    private function applyNodeWhitelistRules(&$servers, $ua)
    {
        $rules = config('v2board.subscribe_node_whitelist_rules', []);
        if (empty($rules) || !is_array($rules)) return;

        // Build map: "type:id" => [allowed UA keyword, ...]
        $restricted = [];
        foreach ($rules as $rule) {
            if (!is_array($rule)) continue;
            $ruleUa = isset($rule['ua']) ? trim((string)$rule['ua']) : '';
            if ($ruleUa === '') continue;
            if (empty($rule['nodes']) || !is_array($rule['nodes'])) continue;
            $uas = preg_split('/[,，|;；\n\r]+/u', $ruleUa, -1, PREG_SPLIT_NO_EMPTY);
                        
            // Support comma-separated multiple UAs
            $uas = explode(',', $ruleUa);
            
            foreach ($rule['nodes'] as $node) {
                if (!is_array($node) || empty($node['type']) || !isset($node['id'])) continue;
                $key = $node['type'] . ':' . (int)$node['id'];
                foreach ($uas as $singleUa) {
                    $singleUa = trim($singleUa);
                    if ($singleUa !== '') {
                        $restricted[$key][] = $singleUa;
                    }
                }
            }
        }
        if (empty($restricted)) return;

        $servers = array_values(array_filter($servers, function ($server) use ($restricted, $ua) {
            $key = ($server['type'] ?? '') . ':' . (isset($server['id']) ? (int)$server['id'] : '');
            if (!isset($restricted[$key])) {
                return true;
            }
            if (empty($ua)) {
                return false;
            }
            foreach ($restricted[$key] as $allowedUa) {
                if ($allowedUa === '') continue;
                if (stripos($ua, $allowedUa) !== false) {
                    return true;
                }
            }
            return false;
        }));
    }

    private function setSubscribeInfoToServers(&$servers, $user)
    {
        if (!isset($servers[0])) return;
        if (!(int)config('v2board.show_info_to_server_enable', 0)) return;
        $useTraffic = $user['u'] + $user['d'];
        $totalTraffic = $user['transfer_enable'];
        $remainingTraffic = Helper::trafficConvert($totalTraffic - $useTraffic);
        $expiredDate = $user['expired_at'] ? date('Y-m-d', $user['expired_at']) : '长期有效';
        $userService = new UserService();
        $resetDay = $userService->getResetDay($user);
        array_unshift($servers, array_merge($servers[0], [
            'name' => "套餐到期：{$expiredDate}",
        ]));
        if ($resetDay) {
            array_unshift($servers, array_merge($servers[0], [
                'name' => "距离下次重置剩余：{$resetDay} 天",
            ]));
        }
        array_unshift($servers, array_merge($servers[0], [
            'name' => "剩余流量：{$remainingTraffic}",
        ]));
    }
}
