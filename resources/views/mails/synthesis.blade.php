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
                <h2 class="section-title">Custom Synthesis Details</h2>
                <div class="detail-row">
                    <span class="detail-label">Molecule Name:</span>
                    <span class="detail-value">{{ $molecule_name ?? 'N/A' }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Purity:</span>
                    <span class="detail-value">{{ $purity ?? 'N/A' }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Molecular Weight:</span>
                    <span class="detail-value">{{ $molecular_weight ?? 'N/A' }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Quantity:</span>
                    <span class="detail-value">{{ $quantity ?? 'N/A' }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Special Instructions:</span>
                    <span class="detail-value">{{ $special_instructions ?? 'N/A' }}</span>
                </div>
                @if($structure_image_url)
                    <div class="detail-row">
                        <span class="detail-label">Structure Image:</span>
                        <span class="detail-value">
                            <img src="{{ asset($structure_image_url) }}" />
                        </span>
                    </div>
                @endif
                <div class="detail-row">
                    <span class="detail-label">Submission Date:</span>
                    <span class="detail-value">{{ $submission_date ?? 'N/A' }}</span>
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
                    <span class="contact-icon"><img src="{{ asset('images/icons/mail-phone.png') }}" width='15' height='15' /></span>
                    +358 46 5534360
                </div>
                <div class="contact-item">
                    <span class="contact-icon"><img src="{{ asset('images/icons/mail-email.png') }}" width='15' height='15' /></span>
                    manvatt@swizchem.com
                </div>
                <div class="contact-item">
                    <span class="contact-icon"><img src="{{ asset('images/icons/mail-globe.png') }}" width='15' height='15' /></span>
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