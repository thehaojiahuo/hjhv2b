<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>流量提示</title>
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
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }

        .header {
            background: #17a2b8;
            padding: 40px 30px;
            text-align: center;
            color: white;
            position: relative;
        }

        .header h1 {
            font-size: 32px;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .header .subtitle {
            font-size: 16px;
            opacity: 0.9;
            font-weight: 400;
        }

        .traffic-icon {
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 24px;
            opacity: 0.8;
        }

        .content {
            padding: 0;
        }

        .content-wrap {
            padding: 40px 30px !important;
        }

        .greeting {
            font-size: 24px;
            color: #2c3e50;
            margin-bottom: 30px;
            font-weight: 600;
            text-align: center;
            position: relative;
        }

        .greeting::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 40px;
            height: 2px;
            background: #17a2b8;
            border-radius: 1px;
        }

        .traffic-notice {
            background: #e8f4fd;
            border: 1px solid #bee5eb;
            border-radius: 8px;
            padding: 30px;
            margin: 30px 0;
            line-height: 1.7;
            color: #0c5460;
            font-size: 16px;
            border-left: 4px solid #17a2b8;
            text-align: center;
        }

        .traffic-usage {
            font-size: 20px;
            font-weight: 600;
            color: #17a2b8;
            margin: 15px 0;
        }

        .progress-bar {
            width: 100%;
            height: 8px;
            background: #e9ecef;
            border-radius: 4px;
            margin: 20px 0;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: #17a2b8;
            border-radius: 4px;
            width: 80%;
            transition: width 0.3s ease;
        }

        .usage-text {
            font-size: 14px;
            color: #6c757d;
            margin-top: 10px;
        }

        .action-section {
            text-align: center;
            margin: 30px 0;
            padding: 25px;
            background: #f8f9fa;
            border-radius: 8px;
            border: 1px solid #e9ecef;
        }

        .action-button {
            display: inline-block;
            background: #17a2b8;
            color: white;
            text-decoration: none;
            padding: 14px 32px;
            border-radius: 6px;
            font-weight: 500;
            font-size: 15px;
            margin: 15px 0;
            transition: background-color 0.2s ease;
            border: none;
        }

        .action-button:hover {
            background: #138496;
        }

        .auto-reply-note {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            border-radius: 8px;
            padding: 20px;
            margin: 25px 0;
            text-align: center;
            position: relative;
        }

        .auto-reply-note::before {
            content: 'ℹ️';
            font-size: 18px;
            margin-right: 10px;
        }

        .auto-reply-text {
            color: #856404;
            font-size: 14px;
            font-weight: 400;
        }

        .footer {
            background: #f8f9fa;
            padding: 30px;
            text-align: center;
            border-top: 1px solid #e9ecef;
        }

        .footer-links {
            margin-bottom: 25px;
        }

        .footer-links a {
            color: #6c757d;
            text-decoration: none;
            margin: 0 15px;
            font-size: 14px;
            font-weight: 400;
            transition: color 0.2s ease;
            padding: 8px 16px;
            border-radius: 4px;
        }

        .footer-links a:hover {
            color: #17a2b8;
            background: rgba(23, 162, 184, 0.1);
        }

        .copyright {
            color: #6c757d;
            font-size: 13px;
            margin-bottom: 20px;
        }

        .contact-info {
            background: #e8f4fd;
            border: 1px solid #bee5eb;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
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
            font-weight: 400;
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
                border-radius: 8px;
            }

            .header, .content-wrap, .footer {
                padding: 30px 20px !important;
            }

            .header h1 {
                font-size: 26px !important;
            }

            .greeting {
                font-size: 20px !important;
            }

            .action-button {
                padding: 12px 28px;
                font-size: 14px;
            }

            .traffic-notice {
                padding: 25px 20px;
            }

            .footer-links a {
                margin: 0 8px;
                font-size: 13px;
                padding: 6px 12px;
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
                    <div class="traffic-icon">📊</div>
                    <h1>流量提示</h1>
                    <div class="subtitle">使用提醒</div>
                </div>
                
                <!-- 主要内容区域 -->
                <div class="content">
                    <div class="content-wrap">
                        <div class="greeting">尊敬的客户，您好！</div>
                        
                        <!-- 流量提醒区域 -->
                        <div class="traffic-notice">
                            <div style="margin-bottom: 15px;">
                                您本月的套餐流量使用情况
                            </div>
                            <div class="traffic-usage">
                                已使用：<strong>95%</strong>
                            </div>
                            
                            <!-- 进度条 -->
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: 95%;"></div>
                            </div>
                            
                            <div class="usage-text">
                                剩余流量：<strong>5%</strong>
                            </div>
                            
                            <div style="margin-top: 20px; font-size: 15px;">
                                请合理安排使用，避免提前耗尽
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
