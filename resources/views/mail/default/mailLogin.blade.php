<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登录授权 - {{ $name }}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap');
        
        body {
            margin: 0;
            padding: 0;
            background-color: #ffffff;
            font-family: 'Inter', -apple-system, sans-serif;
            color: #000000;
        }
        .outer-wrapper {
            padding: 80px 20px;
        }
        .main-container {
            max-width: 520px;
            margin: 0 auto;
        }
        .brand-logo {
            font-size: 14px;
            font-weight: 800;
            letter-spacing: 4px;
            text-transform: uppercase;
            margin-bottom: 80px;
        }
        .title {
            font-size: 32px;
            font-weight: 800;
            letter-spacing: -1px;
            line-height: 1.1;
            margin-bottom: 24px;
        }
        .description {
            font-size: 16px;
            line-height: 1.7;
            color: #666666;
            margin-bottom: 60px;
        }
        .action-area {
            text-align: left;
            margin-bottom: 80px;
        }
        .magic-link {
            display: inline-block;
            background-color: #000000;
            color: #ffffff !important;
            padding: 20px 48px;
            text-decoration: none;
            font-weight: 700;
            font-size: 16px;
            letter-spacing: 1px;
        }
        .security-note {
            font-size: 13px;
            color: #AAAAAA;
            margin-top: 40px;
        }
        .footer {
            font-size: 12px;
            padding-top: 40px;
            border-top: 1px solid #EEEEEE;
        }
        .footer a {
            color: #000000;
            text-decoration: underline;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="outer-wrapper">
        <div class="main-container">
            <div class="brand-logo">{{ $name }}</div>
            
            <h1 class="title">快捷登录授权</h1>
            
            <p class="description">
                您好，<br>
                我们收到了您的登录请求。为了您的账户安全，此链接仅限本次单次使用，点击下方按钮将立即完成授权。
            </p>
            
            <div class="action-area">
                <a href="{{ $link }}" class="magic-link">点击授权并登录 →</a>
                <p class="security-note">链接将在 5 分钟内失效。如非本人操作，请忽略。</p>
            </div>
            
            <div class="footer">
                获取最新官网发送邮件至 <a href="mailto:thehaojiahuo@gmail.com">thehaojiahuo@gmail.com</a>
            </div>
        </div>
    </div>
</body>
</html>
