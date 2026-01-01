<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>网站通知</title>
    <style type="text/css">
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        img {
            max-width: 100%;
        }

        body {
            -webkit-font-smoothing: antialiased;
            -webkit-text-size-adjust: none;
            width: 100% !important;
            height: 100%;
            line-height: 1.6em;
            background-color: #f8f9fa;
            font-family: 'PingFang SC', 'Microsoft YaHei', 'Helvetica Neue', Arial, sans-serif;
            padding: 30px 0;
        }

        .body-wrap {
            width: 100%;
            background: transparent;
            margin: 0;
        }

        .container {
            max-width: 600px !important;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            position: relative;
        }

        .container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: #667eea;
        }

        .header {
            background: #667eea;
            padding: 45px 35px 35px;
            text-align: center;
            color: white;
            position: relative;
        }

        .header h1 {
            font-size: 36px;
            font-weight: 700;
            margin-bottom: 12px;
        }

        .header .subtitle {
            font-size: 17px;
            opacity: 0.95;
            font-weight: 400;
        }

        .notification-icon {
            display: none;
        }

        .content {
            padding: 0;
        }

        .content-wrap {
            padding: 45px 35px !important;
        }

        .greeting {
            font-size: 26px;
            color: #2d3748;
            margin-bottom: 32px;
            font-weight: 600;
            text-align: center;
            position: relative;
        }

        .greeting::after {
            content: '';
            position: absolute;
            bottom: -12px;
            left: 50%;
            transform: translateX(-50%);
            width: 50px;
            height: 3px;
            background: #667eea;
            border-radius: 2px;
        }

        .notification-content {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 35px;
            margin: 32px 0;
            line-height: 1.7;
            color: #4a5568;
            font-size: 16px;
            position: relative;
            border-left: 5px solid #667eea;
        }

        .notification-content::before {
            content: '🔔';
            position: absolute;
            top: -15px;
            left: 35px;
            background: white;
            padding: 8px;
            border-radius: 50%;
            font-size: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .content-title {
            font-size: 18px;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 20px;
            text-align: center;
            position: relative;
        }

        .content-title::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 50%;
            transform: translateX(-50%);
            width: 40px;
            height: 2px;
            background: #667eea;
            border-radius: 1px;
        }

        .content-body {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 25px;
            margin: 20px 0;
            line-height: 1.8;
            color: #2d3748;
            font-size: 16px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .action-section {
            text-align: center;
            margin: 32px 0;
            padding: 28px;
            background: #f8fafc;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
        }

        .action-button {
            display: inline-block;
            background: #667eea;
            color: white;
            text-decoration: none;
            padding: 16px 36px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 16px;
            margin: 18px 0;
            transition: all 0.2s ease;
            border: none;
        }

        .action-button:hover {
            background: #5a67d8;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
        }

        .auto-reply-note {
            background: #fff5f5;
            border: 1px solid #fed7d7;
            border-radius: 10px;
            padding: 22px;
            margin: 28px 0;
            text-align: center;
            position: relative;
        }

        .auto-reply-note::before {
            content: 'ℹ️';
            font-size: 18px;
            margin-right: 10px;
        }

        .auto-reply-text {
            color: #c53030;
            font-size: 14px;
            font-weight: 500;
        }

        .footer {
            background: #f8f9fa;
            padding: 35px;
            text-align: center;
            border-top: 1px solid #e2e8f0;
        }

        .footer-links {
            margin-bottom: 28px;
        }

        .footer-links a {
            color: #6c757d;
            text-decoration: none;
            margin: 0 18px;
            font-size: 15px;
            font-weight: 500;
            transition: color 0.2s ease;
            padding: 9px 18px;
            border-radius: 6px;
            display: inline-block;
        }

        .footer-links a:hover {
            color: #667eea;
            background: rgba(102, 126, 234, 0.1);
        }

        .copyright {
            color: #6c757d;
            font-size: 14px;
            margin-bottom: 22px;
        }

        .contact-info {
            background: #e8f4fd;
            border: 1px solid #bee5eb;
            border-radius: 10px;
            padding: 22px;
            margin: 22px 0;
            position: relative;
        }

        .contact-info::before {
            content: '📧';
            font-size: 18px;
            margin-right: 10px;
        }

        .contact-info a {
            color: #0c5460;
            text-decoration: none;
            font-weight: 500;
        }

        .contact-info a:hover {
            text-decoration: underline;
        }

        @media only screen and (max-width: 640px) {
            body {
                padding: 15px !important;
            }

            .container {
                margin: 0 !important;
                border-radius: 12px;
            }

            .header, .content-wrap, .footer {
                padding: 30px 20px !important;
            }

            .header h1 {
                font-size: 28px !important;
            }

            .greeting {
                font-size: 22px !important;
            }

            .notification-content::before {
                left: 20px;
                top: -12px;
                padding: 6px;
                font-size: 18px;
            }

            .content-title {
                font-size: 16px;
                margin-bottom: 15px;
            }

            .content-body {
                padding: 20px;
                margin: 15px 0;
            }

            .action-button {
                padding: 14px 30px;
                font-size: 15px;
            }

            .notification-content {
                padding: 25px 20px;
            }

            .footer-links a {
                margin: 0 8px;
                font-size: 14px;
                padding: 7px 14px;
            }
        }
    </style>
</head>

<body>
    <table class="body-wrap">
        <tr>
            <td></td>
            <td class="container">
                <!-- 头部区域 -->
                <div class="header">
                    <div class="notification-icon">📢</div>
                    <h1>{{$name}}</h1>
                    <div class="subtitle">重要公告</div>
                </div>
                
                <!-- 主要内容区域 -->
                <div class="content">
                    <div class="content-wrap">
                        <div class="greeting">尊敬的客户，您好！</div>
                        
                        <!-- 通知内容区域 -->
                        <div class="notification-content">
                            <div class="content-title">重要通知</div>
                            <div class="content-body">
                                {!! nl2br($content) !!}
                            </div>
                        </div>
                        
                        <!-- 操作区域 -->

                        
                        <!-- 自动回复提示 -->
                        <div class="auto-reply-note">
                            <span class="auto-reply-text">
                                本邮件由系统自动发出，请勿直接回复
                            </span>
                        </div>
                    </div>
                </div>
                
                <!-- 底部区域 -->
                <div class="footer">
                    <div class="footer-links">
                        <a href="{{$url}}">官方网站</a>
                    </div>
                    
                    <div class="copyright">
                        &copy; {{$name}}. 保留所有权利。
                    </div>
                    
                    <!-- 联系信息 -->
                    <div class="contact-info">
                        <a href="mailto:thehaojiahuo@gmail.com">
                            thehaojiahuo@gmail.com (发送任意内容获取官网地址)
                        </a>
                    </div>
                </div>
            </td>
            <td></td>
        </tr>
    </table>
</body>
</html>
