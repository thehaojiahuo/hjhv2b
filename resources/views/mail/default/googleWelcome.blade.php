<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>欢迎 - {{ $app_name }}</title>
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
        .credential-grid {
            border: 1px solid #EEEEEE;
            padding: 32px;
            margin-bottom: 60px;
        }
        .grid-label {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: #AAAAAA;
            margin-bottom: 8px;
            display: block;
        }
        .grid-value {
            font-size: 18px;
            font-weight: 600;
            color: #000000;
            margin-bottom: 32px;
            display: block;
            font-family: 'SF Mono', 'Monaco', monospace;
        }
        .grid-value:last-child {
            margin-bottom: 0;
        }
        .action-link {
            display: inline-block;
            background-color: #4285F4; /* Google Blue as accent */
            color: #ffffff !important;
            padding: 20px 48px;
            text-decoration: none;
            font-weight: 700;
            font-size: 16px;
            margin-bottom: 80px;
            letter-spacing: 1px;
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
            <div class="brand-logo">{{ $app_name }}</div>
            
            <h1 class="title">入驻成功，{{ $name }}。</h1>
            
            <p class="description">
                您已成功通过 Google 账户激活登录，账户体系已就绪。以下是为您生成的初始访问凭据：
            </p>
            
            <div class="credential-grid">
                <span class="grid-label">Account email</span>
                <span class="grid-value">{{ $email }}</span>
                
                <span class="grid-label">Temporary password</span>
                <span class="grid-value">{{ $password }}</span>
            </div>
            
            <a href="{{ $url }}" class="action-link">立即进入控制台 →</a>
            
            <div class="footer">
                获取最新官网发送邮件至 <a href="mailto:thehaojiahuo@gmail.com">thehaojiahuo@gmail.com</a>
            </div>
        </div>
    </div>
</body>
</html>
