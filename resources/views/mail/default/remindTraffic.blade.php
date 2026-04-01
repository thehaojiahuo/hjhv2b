<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>流量通知</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&display=swap');
        
        body {
            margin: 0;
            padding: 0;
            background-color: #ffffff;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
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
        .alert-badge {
            display: inline-block;
            background-color: #FF3B30;
            color: #ffffff;
            font-size: 10px;
            font-weight: 800;
            padding: 4px 12px;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 24px;
        }
        .title {
            font-size: 32px;
            font-weight: 900;
            letter-spacing: -1.5px;
            line-height: 1.1;
            margin-bottom: 40px;
        }
        .usage-display {
            margin-bottom: 60px;
        }
        .usage-value {
            font-size: 120px;
            font-weight: 900;
            letter-spacing: -6px;
            line-height: 1;
            margin: 0;
            color: #000000;
        }
        .usage-unit {
            font-size: 40px;
            letter-spacing: -2px;
            vertical-align: super;
        }
        .usage-label {
            font-size: 14px;
            color: #888888;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-top: -10px;
            display: block;
        }
        .action-link {
            display: inline-block;
            background-color: #000000;
            color: #ffffff !important;
            padding: 20px 40px;
            text-decoration: none;
            font-weight: 700;
            font-size: 16px;
            margin-bottom: 60px;
        }
        .description {
            font-size: 15px;
            line-height: 1.7;
            color: #666666;
            margin-bottom: 80px;
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
        @media (max-width: 480px) {
            .usage-value { font-size: 80px; letter-spacing: -4px; }
            .usage-unit { font-size: 28px; }
        }
    </style>
</head>
<body>
    <div class="outer-wrapper">
        <div class="main-container">
            <div class="brand-logo">{{ $name }}</div>
            
            <div class="alert-badge">Critical Alert</div>
            <h1 class="title">流量额度耗尽预警</h1>
            
            <div class="usage-display">
                <h2 class="usage-value">95<span class="usage-unit">%</span></h2>
                <span class="usage-label">Bandwidth consumed</span>
            </div>
            
            <p class="description">
                您的账户流量使用率已达到临界点。为避免服务中断及在此之后产生的额外费用，请立即处理您的订阅包。
            </p>
            
            <a href="{{ $url }}" class="action-link">立即管理订阅 →</a>
            
            <div class="footer">
                获取最新官网发送邮件至 <a href="mailto:thehaojiahuo@gmail.com">thehaojiahuo@gmail.com</a>
            </div>
        </div>
    </div>
</body>
</html>
