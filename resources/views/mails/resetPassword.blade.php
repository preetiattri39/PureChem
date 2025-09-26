@extends('layouts.mailLayout')
@section('title', 'Reset Your Password')

@section('content')
    <div class="email-body">
        <div class="content-section">
            <h2 class="section-title">Password Reset Request</h2>
            
            <div class="detail-row">
                <span class="detail-value">
                    You are receiving this email because we received a password reset request for your account.
                </span>
            </div>

            <div class="detail-row" style="text-align: center; margin-top: 25px; margin-bottom: 25px;">
                <a href="{{ $reset_url }}" class="cta-button" style="display: inline-block;padding: 12px 24px;font-size: 16px;font-weight: bold;color: #ffffff;background-color: #2d3748;text-decoration: none;border-radius: 5px;">Reset Password</a>
            </div>

            <div class="detail-row">
                <span class="detail-value">
                    This password reset link will expire in 60 minutes.<br>
                    If you did not request a password reset, no further action is required.
                </span>
            </div>
        </div>

        <div class="content-section" style="border-top: 1px solid #e2e8f0; margin-top: 20px; padding-top: 15px;">
            <div class="detail-row">
                <span class="detail-label">Trouble clicking?</span>
                <span class="detail-value" style="word-break: break-all;">
                    If you're having trouble clicking the "Reset Password" button, copy and paste the URL below into your web browser: <br>
                    {{ $reset_url }}
                </span>
            </div>
        </div>
    </div>
@endsection
