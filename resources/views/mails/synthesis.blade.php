@extends('layouts.mailLayout') 
@section('title','New Custom Synthesis Submission')
@section('content')
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
                <span class="detail-label">Molecular Formula:</span>
                <span class="detail-value">{{ $molecular_formula ?? 'N/A' }}</span>
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
@endsection