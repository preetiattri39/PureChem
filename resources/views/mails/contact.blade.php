@extends('layouts.mailLayout') 
@section('title','Contact Form Submission')
@section('content')
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
@endsection