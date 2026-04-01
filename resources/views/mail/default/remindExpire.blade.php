<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>过期预警 - {{ $name }}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&display=swap');
        
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
        .warning-badge {
            display: inline-block;
            border: 1px solid #FF3B30;
            color: #FF3B30;
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
        .time-box {
            margin-bottom: 60px;
        }
        .time-value {
            font-size: 120px;
            font-weight: 900;
            letter-spacing: -6px;
            line-height: 1;
            margin: 0;
        }
        .time-unit {
            font-size: 32px;
            letter-spacing: -1px;
            margin-left: 8px;
        }
        .time-label {
            font-size: 14px;
            color: #888888;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-top: -10px;
            display: block;
        }
        .action-btn {
            display: inline-block;
            background-color: #000000;
            color: #ffffff !important;
            padding: 20px 48px;
            text-decoration: none;
            font-weight: 700;
            font-size: 16px;
            margin-bottom: 60px;
            letter-spacing: 1px;
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
    </style>
</head>
<body>
    <div class="outer-wrapper">
        <div class="main-container">
            <div class="brand-logo">{{ $name }}</div>
            
            <div class="warning-badge">Service Expiry</div>
            <h1 class="title">您的订阅即将到期</h1>
            
            <div class="time-box">
                <h2 class="time-value">24<span class="time-unit">HRS</span></h2>
                <span class="time-label">Remaining subscription time</span>
            </div>
            
            <p class="description">
                你的服务将在 {{ $expire_in_days ?? 1 }} 天内停止运行。为了保持业务连续性，请及时通过下方的快捷链接完成续费。
            </p>
            
            <a href="{{ $url }}" class="action-btn">立即续费订阅 →</a>
            
            <div class="footer">
                获取最新官网发送邮件至 <a href="mailto:thehaojiahuo@gmail.com">thehaojiahuo@gmail.com</a>
            </div>
        </div>
    </div>
</body>
</html>
