<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form Submission - Swizchem</title>
    @include('mails.partials.styles')
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <img src="{{ asset('images/logo/mail-logo.jpg') }}" alt="Swizchem Logo" class="logo"> 
            <h1 class="header-title">New Contact Form Submission</h1>
        </div>
        
        <div class="email-body">
            <div class="content-section">
                <h2 class="section-title">Contact Information</h2>
                <div class="detail-row">
                    <span class="detail-label">Name:</span>
                    <span class="detail-value">{{ $name }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Email:</span>
                    <span class="detail-value">{{ $email }}</span>
                </div>
                @if(!empty($phone))
                <div class="detail-row">
                    <span class="detail-label">Phone:</span>
                    <span class="detail-value">{{ $phone }}</span>
                </div>
                @endif
            </div>
            
            <div class="content-section">
                <h2 class="section-title">Message</h2>
                <div class="message-content">
                    {{ $instructions }}
                </div>
            </div>
        </div>
        
        <div class="email-footer">
            <div class="follow-us">Follow Us</div>
            
            <div class="social-icons">
                <a href="#" class="social-icon"><img src="{{ asset('images/icons/instagram.png') }}" /></a>
                <a href="#" class="social-icon"><img src="{{ asset('images/icons/linkedin.png') }}" /></a>
                <a href="#" class="social-icon"><img src="{{ asset('images/icons/facebook.png') }}" /></a>
            </div>
            
            <div class="divider"></div>
            
            <div class="contact-info">
                <div class="contact-item">
                    <span class="contact-icon"><img src="{{ asset('images/icons/mail-phone.png') }}" /></span>
                    +358 46 5534360
                </div>
                <div class="contact-item">
                    <span class="contact-icon"><img src="{{ asset('images/icons/mail-email.png') }}" /></span>
                    manvatt@swizchem.com
                </div>
                <div class="contact-item">
                    <span class="contact-icon"><img src="{{ asset('images/icons/mail-globe.png') }}" /></span>
                    www.swizchem.com
                </div>
            </div>
            
            <div class="divider"></div>
            
            <div class="company-info">
                <strong>Address:</strong> A326, A.I. Virtasen Aukio 1, 00560 Helsinki, Finland<br>
                <strong>Hours:</strong> Monday to Thursday 9:00 AM - 3:30 PM<br><br>
                <em>© 2025 Swizchem. All rights reserved.</em>
            </div>
        </div>
    </div>
</body>
</html>