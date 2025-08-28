@extends('layouts.mailLayout') 
@section('title','New RFQ Submission')
@section('content')
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
@endsection