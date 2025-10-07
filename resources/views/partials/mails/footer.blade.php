<div class="email-footer">
    <div class="follow-us">Follow Us</div>
    
    <div class="social-icons">
        <a href="https://www.instagram.com/swizchem/" target="_blank" class="social-icon"><img src="{{ asset('images/icons/instagram.png') }}" /></a>
        <a href="https://www.linkedin.com/company/swizchem-ltd/about/?viewAsMember=true" class="social-icon" target="_blank" ><img src="{{ asset('images/icons/linkedin.png') }}" /></a>
        <a href="https://www.facebook.com/people/Swizchem/61580295942375/" class="social-icon" target="_blank" ><img src="{{ asset('images/icons/facebook.png') }}" /></a>
    </div>
    
    <div class="divider"></div>
    
    <div class="contact-info">
        <div class="contact-item">
            <span class="contact-icon"><img src="{{ asset('images/icons/mail-phone.png') }}"  width='15' height='15' /></span>
            {{ replace_shortcodes('[admin-ph-1]') }}
        </div>
        <div class="contact-item">
            <span class="contact-icon"><img src="{{ asset('images/icons/mail-email.png') }}"  width='15' height='15' /></span>
            {{ replace_shortcodes('[admin-email-1]') }}
        </div>
        <div class="contact-item">
            <span class="contact-icon"><img src="{{ asset('images/icons/mail-globe.png') }}"  width='15' height='15' /></span>
            www.swizchem.com
        </div>
    </div>
    
    <div class="divider"></div>
    
    <div class="company-info">
        <strong>Address:</strong> {{ replace_shortcodes('[admin-address-1]') }}<br>
        <strong>Hours:</strong>{{ replace_shortcodes('[working-days-open]') }} to {{ replace_shortcodes('[working-days-close]') }} {{ replace_shortcodes('[working-hours-open]') }} - {{ replace_shortcodes('[working-hours-close]') }}<br><br>
        <strong>Hours:</strong>{{ replace_shortcodes('[exception-day-1]') }} {{ replace_shortcodes('[exception-day-1-working-hours-open]') }} - {{ replace_shortcodes('[exception-day-1-working-hours-close]') }}<br>
        <em>© 2025 Swizchem. All rights reserved.</em>
    </div>
</div>