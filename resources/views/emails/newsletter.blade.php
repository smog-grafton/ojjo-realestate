<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $newsletter->name }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f8f9fa;
        }
        
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .email-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px 20px;
            text-align: center;
        }
        
        .logo {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        
        .header-subtitle {
            font-size: 16px;
            opacity: 0.9;
        }
        
        .email-content {
            padding: 40px 30px;
        }
        
        .greeting {
            font-size: 18px;
            margin-bottom: 20px;
            color: #2c3e50;
        }
        
        .newsletter-content {
            font-size: 15px;
            line-height: 1.7;
            margin-bottom: 30px;
        }
        
        .newsletter-content h1,
        .newsletter-content h2,
        .newsletter-content h3 {
            margin: 25px 0 15px 0;
            color: #2c3e50;
        }
        
        .newsletter-content h1 {
            font-size: 24px;
        }
        
        .newsletter-content h2 {
            font-size: 20px;
        }
        
        .newsletter-content h3 {
            font-size: 18px;
        }
        
        .newsletter-content p {
            margin-bottom: 15px;
        }
        
        .newsletter-content ul,
        .newsletter-content ol {
            margin: 15px 0;
            padding-left: 20px;
        }
        
        .newsletter-content blockquote {
            border-left: 4px solid #667eea;
            background-color: #f8f9fa;
            padding: 15px 20px;
            margin: 20px 0;
            font-style: italic;
        }
        
        .newsletter-content a {
            color: #667eea;
            text-decoration: none;
        }
        
        .newsletter-content a:hover {
            text-decoration: underline;
        }
        
        .cta-section {
            text-align: center;
            margin: 30px 0;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 8px;
        }
        
        .cta-button {
            display: inline-block;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 25px;
            font-weight: bold;
            margin-top: 15px;
        }
        
        .email-footer {
            background-color: #2c3e50;
            color: white;
            padding: 30px 20px;
            text-align: center;
        }
        
        .footer-content {
            margin-bottom: 20px;
        }
        
        .social-links {
            margin: 20px 0;
        }
        
        .social-links a {
            color: white;
            text-decoration: none;
            margin: 0 10px;
            font-size: 18px;
        }
        
        .unsubscribe {
            font-size: 12px;
            color: #bdc3c7;
            margin-top: 15px;
        }
        
        .unsubscribe a {
            color: #bdc3c7;
            text-decoration: underline;
        }
        
        .divider {
            height: 1px;
            background-color: #ecf0f1;
            margin: 30px 0;
        }
        
        @media only screen and (max-width: 600px) {
            .email-container {
                margin: 0;
                width: 100% !important;
            }
            
            .email-content {
                padding: 20px 15px;
            }
            
            .email-header {
                padding: 20px 15px;
            }
            
            .logo {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Email Header -->
        <div class="email-header">
            <div class="logo">Ojjo Estates</div>
            <div class="header-subtitle">East Africa's Premier Real Estate Platform</div>
        </div>
        
        <!-- Email Content -->
        <div class="email-content">
            <div class="greeting">
                Hello {{ $subscriber->name ?? 'Valued Subscriber' }}!
            </div>
            
            <div class="newsletter-content">
                {!! $content !!}
            </div>
            
            <!-- Call to Action Section -->
            @if($newsletter->name !== 'Welcome Email')
            <div class="cta-section">
                <h3>Explore Our Latest Properties</h3>
                <p>Discover amazing real estate opportunities across East Africa</p>
                <a href="{{ config('app.url') }}" class="cta-button">Browse Properties</a>
            </div>
            @endif
            
            <div class="divider"></div>
            
            <!-- Contact Information -->
            <div style="background-color: #f8f9fa; padding: 20px; border-radius: 8px; margin-top: 20px;">
                <h4 style="margin-bottom: 15px; color: #2c3e50;">Stay Connected</h4>
                <p style="margin-bottom: 10px;">
                    <strong>Email:</strong> info@ojjoestates.com<br>
                    <strong>Phone:</strong> +256 700 000 000<br>
                    <strong>Website:</strong> <a href="{{ config('app.url') }}">www.ojjoestates.com</a>
                </p>
            </div>
        </div>
        
        <!-- Email Footer -->
        <div class="email-footer">
            <div class="footer-content">
                <strong>Ojjo Estates</strong><br>
                Your trusted partner in East African real estate
            </div>
            
            <div class="social-links">
                <a href="#" title="Facebook">📘</a>
                <a href="#" title="Twitter">🐦</a>
                <a href="#" title="LinkedIn">💼</a>
                <a href="#" title="Instagram">📷</a>
            </div>
            
            <div class="unsubscribe">
                You're receiving this email because you subscribed to our newsletter.<br>
                <a href="{{ $unsubscribeUrl }}">Unsubscribe</a> | 
                <a href="{{ config('app.url') }}">Update Preferences</a>
                <br><br>
                © {{ date('Y') }} Ojjo Estates. All rights reserved.
            </div>
        </div>
    </div>
</body>
</html> 