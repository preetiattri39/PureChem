@extends('layouts.mailLayout')
@section('title', 'Verify Your Email Address')

@section('content')
    <div class="email-body">
        <div class="content-section">
            <h2 class="section-title">Welcome! Please Verify Your Email</h2>
            
            <div class="detail-row">
                <span class="detail-value">Thanks for signing up! Please click the button below to confirm your email address and activate your account.</span>
            </div>

            <div class="detail-row" style="text-align: center; margin-top: 25px; margin-bottom: 25px;">
                <a href="{{ $verification_url }}" class="cta-button" style="display: inline-block;padding: 12px 24px;font-size: 16px;font-weight: bold;color: #ffffff;background-color: #2d3748;text-decoration: none;border-radius: 5px;">Verify Email Address</a>
            </div>

            <div class="detail-row">
                <span class="detail-value">If you did not create an account, no further action is required.</span>
            </div>
        </div>

        <div class="content-section" style="border-top: 1px solid #e2e8f0; margin-top: 20px; padding-top: 15px;">
             <div class="detail-row">
                <span class="detail-label">Trouble clicking?</span>
                <span class="detail-value" style="word-break: break-all;">If you're having trouble clicking the "Verify Email Address" button, copy and paste the URL below into your web browser: <br>{{ $verification_url }}</span>
            </div>
        </div>
    </div>
@endsection