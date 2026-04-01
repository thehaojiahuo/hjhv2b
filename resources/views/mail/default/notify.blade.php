<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>通知 - {{ $name }}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;700;800&display=swap');
        
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
        .description-top {
            font-size: 16px;
            color: #888888;
            margin-bottom: 40px;
        }
        .message-content {
            font-size: 18px;
            line-height: 1.6;
            color: #000000;
            padding: 40px 0;
            border-top: 1px solid #000000;
            border-bottom: 1px solid #EEEEEE;
            margin-bottom: 60px;
        }
        .message-content p {
            margin: 0 0 14px 0;
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
            
            <h1 class="title">系统通知</h1>
            <p class="description-top">来自 {{ $name }} 的官方消息：</p>
            
            <div class="message-content">
                {!! $content !!}
            </div>
            
            <div class="footer">
                获取最新官网发送邮件至 
                <a href="mailto:thehaojiahuo@gmail.com">thehaojiahuo@gmail.com</a>
            </div>
        </div>
    </div>
</body>
</html>
