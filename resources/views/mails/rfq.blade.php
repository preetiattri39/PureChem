<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New RFQ Submission - Swizchem</title>
    @include('mails.partials.styles')
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <img src="{{ asset('images/logo/mail-logo.jpg') }}" alt="Swizchem Logo" class="logo">
            <h1 class="header-title">New RFQ Submission</h1>
        </div>
        
        <div class="email-body">
            <div class="content-section"> 
                <h2 class="section-title">Customer Info</h2>
                <div class="detail-row">
                    <span class="detail-label">Name:</span>
                    <span class="detail-value">{{ $info['name'] ?? 'N/A' }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">address:</span>
                    <span class="detail-value">{{ $info['address'] ?? 'N/A' }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">City:</span>
                    <span class="detail-value">${{ $info['city'] ?? 'N/A' }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">state:</span>
                    <span class="detail-value">{{ $info['state'] ?? 'N/A' }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Country:</span>
                    <span class="detail-value">{{ $info['country'] ?? 'N/A' }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Postal Code:</span>
                    <span class="detail-value">{{ $info['postal_code'] ?? 'N/A' }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Phone:</span>
                    <span class="detail-value">{{ $info['phone'] ?? 'N/A' }}</span>
                </div>
            </div>

            <div class="content-section">
                <h2 class="section-title">RFQ Details</h2>
                @php $counter = 1; @endphp
                @foreach($orderDetail as $item)
                    <div class="detail-row">
                        <span class="detail-label">{{ $counter }}. </span>
                        <span class="detail-value">{{ $item['product_name'] ?? 'N/A' }} </span>
                        <span class="detail-value">{{ $item['cas_number'] ?? 'N/A' }} </span>
                        <span class="detail-value">{{ $item['quantity'] ?? 'N/A' }} </span>
                    </div>
                @php $counter++; @endphp
                @endforeach
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