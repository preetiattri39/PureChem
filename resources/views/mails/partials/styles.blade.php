<style>
    * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

a{
    color: #ffffff;
    text-decoration: none;
}

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    line-height: 1.6;
    color: #333;
    background-color: #f4f4f4;
}

.email-container {
    max-width: 600px;
    margin: 0 auto;
    background-color: #ffffff;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
}

.email-header {
    background-color: #28435D;
    padding: 30px 20px;
    text-align: center;
    border-radius: 8px 8px 0 0;
}

.logo {
    max-width: 200px;
    height: auto;
    margin-bottom: 10px;
}

.header-title {
    color: #ffffff;
    font-size: 24px;
    font-weight: 600;
    margin: 0;
    text-shadow: 0 2px 4px rgba(0,0,0,0.3);
}

.email-body {
    padding: 40px 30px;
    background: url('/images/web/swizchem-logo-3x.png');
    position: relative;
}

.content-section {
    background-color: rgba(255,255,255,0.9);
    padding: 25px;
    border-radius: 8px;
    margin-bottom: 20px;
    border-left: 4px solid #28435D;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
}

.section-title {
    color: #28435D;
    font-size: 20px;
    font-weight: 600;
    margin-bottom: 15px;
    border-bottom: 2px solid #e0e0e0;
    padding-bottom: 8px;
}

.detail-row {
    display: flex;
    margin-bottom: 12px;
    padding: 8px 0;
    border-bottom: 1px solid #f0f0f0;
}

.detail-row:last-child {
    border-bottom: none;
}

.detail-label {
    font-weight: 600;
    color: #28435D;
    min-width: 120px;
    margin-right: 15px;
}

.detail-value {
    color: #555;
    flex: 1;
    word-break: break-word;
    margin-right: 20px;
}

.message-content {
    background-color: #f8f9fa;
    padding: 15px;
    border-radius: 6px;
    border-left: 4px solid #28435D;
    font-style: italic;
    margin-top: 10px;
}

.email-footer {
    background-color: #28435D;
    color: #ffffff;
    padding: 30px 20px;
    text-align: center;
    border-radius: 0 0 8px 8px;
}

.follow-us {
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 20px;
    color: #ffffff;
}

.social-icons {
    margin-bottom: 25px;
}

.social-icon {
    display: inline-block;
    width: 40px;
    height: 40px;
    margin: 0 8px;
    background-color: rgba(255,255,255,0.2);
    border-radius: 50%;
    text-align: center;
    line-height: 40px;
    color: #ffffff;
    text-decoration: none;
    transition: all 0.3s ease;
    font-size: 16px;
}

.social-icon:hover {
    background-color: rgba(255,255,255,0.3);
    transform: translateY(-2px);
}

.contact-info {
    margin-bottom: 20px;
    line-height: 1.8;
}

.contact-info a{
    color: #ffffff;
}

.contact-item {
    margin-bottom: 8px;
    color: #ffffff;
}

.contact-icon {
    margin-right: 8px;
    opacity: 0.8;
}

.company-info {
    font-size: 14px;
    opacity: 0.9;
    line-height: 1.6;
}

.divider {
    height: 1px;
    background: linear-gradient(to right, transparent, rgba(255,255,255,0.3), transparent);
    margin: 20px 0;
}

@media screen and (max-width: 600px) {
    .email-container {
        margin: 10px;
        max-width: none;
    }
    
    .email-body {
        padding: 20px 15px;
    }
    
    .content-section {
        padding: 15px;
    }
    
    .detail-row {
        flex-direction: column;
    }
    
    .detail-label {
        min-width: auto;
        margin-bottom: 5px;
    }
    
    .social-icon {
        width: 35px;
        height: 35px;
        line-height: 35px;
        margin: 0 5px;
    }
}
</style>