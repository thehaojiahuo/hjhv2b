<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>邮箱验证码</title>
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

        .verification-icon {
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
            background: #667eea;
            border-radius: 1px;
        }

        .verification-notice {
            background: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            padding: 25px;
            margin: 30px 0;
            line-height: 1.7;
            color: #495057;
            font-size: 16px;
            text-align: center;
        }

        .verification-code {
            background: #f8f9fa;
            border: 2px solid #667eea;
            border-radius: 12px;
            padding: 35px;
            margin: 30px 0;
            text-align: center;
            position: relative;
        }

        .code-label {
            font-size: 18px;
            color: #2c3e50;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .code-container {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 15px;
            margin: 25px 0;
            flex-wrap: wrap;
            min-height: 75px;
        }

        .code-digit {
            min-width: 65px;
            height: 75px;
            background: white;
            border: 2px solid #667eea;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            font-weight: 700;
            color: #667eea;
            font-family: 'Courier New', monospace;
            box-shadow: 0 2px 8px rgba(102, 126, 234, 0.15);
            padding: 0 15px;
        }

        .code-validity {
            font-size: 14px;
            color: #6c757d;
            margin-top: 20px;
            font-weight: 400;
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
            background: #667eea;
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
            background: #5a67d8;
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
            color: #667eea;
            background: rgba(102, 126, 234, 0.1);
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

            .code-container {
                gap: 10px;
                margin: 20px 0;
            }

            .code-digit {
                width: 55px;
                height: 65px;
                font-size: 28px;
            }

            .action-button {
                padding: 12px 28px;
                font-size: 14px;
            }

            .verification-notice, .verification-code {
                padding: 20px 15px;
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
                    <div class="verification-icon">🔐</div>
                    <h1>邮箱验证码</h1>
                    <div class="subtitle">安全验证</div>
                </div>
                
                <!-- 主要内容区域 -->
                <div class="content">
                    <div class="content-wrap">
                        <div class="greeting">尊敬的客户，您好！</div>
                        
                        <!-- 验证说明 -->
                        <div class="verification-notice">
                            请填写以下验证码完成邮箱验证
                        </div>
                        
                        <!-- 验证码显示区域 -->
                        <div class="verification-code">
                            <div class="code-label">您的验证码是：</div>
                            <div class="code-container" id="codeContainer">
                                <!-- 备用显示方案 - 显示完整验证码 -->
                                <div class="code-digit" style="min-width: 200px; text-align: center; font-size: 28px; padding: 20px;">{{$code}}</div>
                            </div>
                            <div class="code-validity">5分钟内有效</div>
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

    <script>
        // 动态生成验证码格子
        function generateCodeDigits() {
            const codeContainer = document.getElementById('codeContainer');
            const verificationCode = '{{$code}}'; // 从模板变量获取验证码
            
            console.log('原始验证码:', verificationCode); // 调试信息
            console.log('验证码类型:', typeof verificationCode); // 调试信息
            console.log('验证码长度:', verificationCode.length); // 调试信息
            
            if (codeContainer && verificationCode && verificationCode !== '{{$code}}' && verificationCode.trim() !== '') {
                // 检查验证码是否真实存在（不是模板变量且不为空）
                const digits = verificationCode.toString().split('');
                console.log('分割后的数字:', digits); // 调试信息
                console.log('数字数量:', digits.length); // 调试信息
                
                // 清空容器，准备重新生成格子
                codeContainer.innerHTML = '';
                
                // 为每个数字创建一个格子
                digits.forEach((digit, index) => {
                    if (digit && digit.trim() !== '') { // 确保不是空格
                        const digitBox = document.createElement('div');
                        digitBox.className = 'code-digit';
                        digitBox.textContent = digit;
                        digitBox.style.borderColor = '#667eea';
                        digitBox.style.color = '#667eea';
                        digitBox.style.background = 'white';
                        
                        // 添加动画效果
                        digitBox.style.opacity = '0';
                        digitBox.style.transform = 'scale(0.8)';
                        digitBox.style.transition = 'all 0.3s ease';
                        
                        codeContainer.appendChild(digitBox);
                        
                        // 依次显示每个格子
                        setTimeout(() => {
                            digitBox.style.opacity = '1';
                            digitBox.style.transform = 'scale(1)';
                        }, index * 100);
                    }
                });
                
                // 如果没有有效数字，显示错误信息
                if (codeContainer.children.length === 0) {
                    codeContainer.innerHTML = '<div style="color: #dc3545; font-size: 16px; padding: 20px;">验证码格式错误</div>';
                }
            } else {
                console.log('验证码未找到、为模板变量或为空，使用HTML备用显示'); // 调试信息
                // 如果JavaScript无法获取验证码，保持HTML中的备用显示
                const digitBoxes = codeContainer.querySelectorAll('.code-digit');
                digitBoxes.forEach((box, index) => {
                    // 添加动画效果
                    box.style.opacity = '0';
                    box.style.transform = 'scale(0.8)';
                    box.style.transition = 'all 0.3s ease';
                    
                    setTimeout(() => {
                        box.style.opacity = '1';
                        box.style.transform = 'scale(1)';
                    }, index * 100);
                });
            }
        }
        
        // 页面加载完成后执行
        document.addEventListener('DOMContentLoaded', generateCodeDigits);
        
        // 如果DOMContentLoaded已经触发，立即执行
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', generateCodeDigits);
        } else {
            generateCodeDigits();
        }
    </script>
</body>
</html> 
