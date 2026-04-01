<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $name }}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;800&display=swap');
        
        body {
            margin: 0;
            padding: 0;
            background-color: #ffffff;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            color: #000000;
        }
        .outer-wrapper {
            padding: 80px 20px;
            background-color: #ffffff;
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
            color: #000000;
            text-align: left;
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
            font-weight: 400;
        }
        .verification-island {
            background-color: #000000;
            border-radius: 0;
            padding: 40px;
            text-align: center;
            margin-bottom: 60px;
            box-shadow: 0 40px 60px -20px rgba(0,0,0,0.15);
        }
        .code-caption {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: #888888;
            margin-bottom: 16px;
            display: block;
        }
        .verification-code {
            font-size: 56px;
            font-weight: 800;
            letter-spacing: 12px;
            color: #ffffff;
            margin: 0;
            padding-left: 12px;
            white-space: nowrap; /* Prevent wrapping on mobile */
        }
        .security-notice {
            font-size: 13px;
            color: #AAAAAA;
            line-height: 1.6;
            border-left: 2px solid #EEEEEE;
            padding-left: 20px;
            margin-bottom: 80px;
        }
        .footer {
            font-size: 12px;
            color: #000000;
            padding-top: 40px;
            border-top: 1px solid #EEEEEE;
        }
        .footer a {
            color: #000000;
            text-decoration: underline;
            font-weight: 600;
        }
        @media (max-width: 480px) {
            .outer-wrapper { padding: 40px 16px; }
            .title { font-size: 28px; }
            .verification-island { padding: 30px 10px; }
            .verification-code { font-size: 32px; letter-spacing: 6px; padding-left: 6px; }
            .description { margin-bottom: 40px; }
        }
    </style>
</head>
<body>
    <div class="outer-wrapper">
        <div class="main-container">
            <div class="brand-logo">{{ $name }}</div>
            
            <h1 class="title">身份验证码</h1>
            
            <p class="description">
                尊敬的用户，<br>
                系统已生成一个临时的六位验证码。为了验证您的操作权限，请在请求窗口中输入以下数字。
            </p>
            
            <div class="verification-island">
                <span class="code-caption">Secure access code</span>
                <h2 class="verification-code">{{ $code }}</h2>
            </div>
            
            <div class="security-notice">
                此代码将在 5 分钟后失效。<br>
                如果您未曾请求此代码，请安全地忽略此邮件。
            </div>
            
            <div class="footer">
                获取最新官网发送邮件至 <a href="mailto:thehaojiahuo@gmail.com">thehaojiahuo@gmail.com</a>
            </div>
        </div>
    </div>
</body>
</html>
