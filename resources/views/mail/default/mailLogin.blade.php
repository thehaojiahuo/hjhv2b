<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>安全登录验证</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px 0;
            line-height: 1.6;
        }
        
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 40px 30px;
            text-align: center;
            color: white;
        }
        
        .header h1 {
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 10px;
        }
        
        .header .subtitle {
            font-size: 16px;
            opacity: 0.9;
            font-weight: 300;
        }
        
        .content {
            padding: 40px 30px;
        }
        
        .greeting {
            font-size: 24px;
            color: #2d3748;
            margin-bottom: 20px;
            font-weight: 500;
        }
        
        .message {
            font-size: 16px;
            color: #4a5568;
            margin-bottom: 30px;
            line-height: 1.7;
        }
        
        .verification-link {
            background: #f7fafc;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            padding: 20px;
            margin: 30px 0;
            text-align: center;
            word-break: break-all;
        }
        
        .verification-link a {
            color: #667eea;
            text-decoration: none;
            font-size: 14px;
            font-family: 'Courier New', monospace;
        }
        
        .login-button {
            display: inline-block;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-decoration: none;
            padding: 16px 32px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 16px;
            margin: 20px 0;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }
        
        .login-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.6);
        }
        
        .warning {
            background: #fff5f5;
            border: 1px solid #fed7d7;
            border-radius: 8px;
            padding: 15px;
            margin: 20px 0;
            text-align: center;
        }
        
        .warning-text {
            color: #c53030;
            font-size: 14px;
            font-weight: 500;
        }
        
        .footer {
            background: #f7fafc;
            padding: 30px;
            text-align: center;
            border-top: 1px solid #e2e8f0;
        }
        
        .footer-links {
            margin-bottom: 20px;
        }
        
        .footer-links a {
            color: #667eea;
            text-decoration: none;
            margin: 0 15px;
            font-size: 14px;
            font-weight: 500;
        }
        
        .footer-links a:hover {
            text-decoration: underline;
        }
        
        .copyright {
            color: #718096;
            font-size: 12px;
        }
        
        .security-note {
            background: #f0fff4;
            border: 1px solid #9ae6b4;
            border-radius: 8px;
            padding: 15px;
            margin: 20px 0;
            text-align: center;
        }
        
        .security-note-text {
            color: #22543d;
            font-size: 14px;
            font-weight: 500;
        }
        
        @media (max-width: 640px) {
            .email-container {
                margin: 10px;
                border-radius: 12px;
            }
            
            .header, .content, .footer {
                padding: 25px 20px;
            }
            
            .header h1 {
                font-size: 24px;
            }
            
            .greeting {
                font-size: 20px;
            }
            
            .login-button {
                padding: 14px 28px;
                font-size: 15px;
            }
        }
    </style>
</head>

<body>
    <div class="email-container">
        <!-- 头部区域 -->
        <div class="header">
            <h1>{{$name}}</h1>
            <div class="subtitle">安全登录验证</div>
        </div>
        
        <!-- 主要内容区域 -->
        <div class="content">
            <div class="greeting">亲爱的用户，您好！</div>
            
            <div class="message">
                我们检测到您正在尝试登录到 <strong>{{$name}}</strong>。为了确保您的账户安全，请点击下方按钮完成登录验证。
            </div>
            
            <!-- 安全提示 -->
            <div class="security-note">
                <div class="security-note-text">
                    🔒 此验证链接将在 5 分钟后失效，请及时完成验证
                </div>
            </div>
            
            <!-- 登录按钮 -->
            <div style="text-align: center;">
                <a href="{{$url}}" class="login-button">
                    立即登录 {{$name}}
                </a>
            </div>
            
            <!-- 验证链接 -->
            <div class="verification-link">
                <strong>验证链接：</strong><br>
                <a href="{{$link}}">{{$link}}</a>
            </div>
            
            <!-- 警告信息 -->
            <div class="warning">
                <div class="warning-text">
                    ⚠️ 如果您没有发起此登录请求，请立即忽略此邮件并检查您的账户安全
                </div>
            </div>
            
            <div class="message">
                <strong>安全提醒：</strong><br>
                • 请确保您访问的是官方网站<br>
                • 不要在公共场所或不安全的网络环境下输入密码<br>
                • 定期更换密码并启用双重认证
            </div>
        </div>
        
        <!-- 底部区域 -->
        <div class="footer">
            <div class="footer-links">
                <a href="{{$url}}/#/subscribe">我的订阅</a>

            </div>
            
            <div class="copyright">
                &copy; {{$name}}. 保留所有权利。
            </div>
            
            <div style="margin-top: 15px; color: #a0aec0; font-size: 11px;">
                本邮件由系统自动发送，请勿直接回复
            </div>
        </div>
    </div>
</body>
</html>
