@extends('layouts.main.mainLayout')

@section('title', 'Contact Swizchem | Get in Touch with Our Team')
@section('meta_description', 'Reach out to Swizchem via phone, email, or our online form. We respond to product requests and inquiries within 24 hours.')
@section('meta_keywords', 'Contact Swizchem, Swizchem email, customer support, chemical inquiry, request quote, Swizchem phone number, compound request form')

{{-- Open Graph for Facebook/LinkedIn --}}
@section('og_title', View::getSection('title'))
@section('og_description', View::getSection('meta_description'))

{{-- Twitter Card --}}
@section('twitter_title', View::getSection('title'))
@section('twitter_description', View::getSection('meta_description'))

@section('vite')
    @vite(['resources/css/pages/contact.css','resources/js/pages/contact.js'])
@endsection

@section('content')

<!-- Hero Section -->
<section class="inner-hero sh-custom-bg-light align-items-center">
    <div class="container">
        <h1 class="display-5 fw-bold">{{ $content['heroTitle']  }}</h1>
    </div>
</section>
<section class="py-5 contact-page">
    <div class="container pb-5">
        <div class="row g-5">
            <div class="col-md-6">
                <div class="mb-4">
                    <h2 class="section-title">{{ $content['formTitle']  }}</h2>
                </div>
                <div class="form-wrap">
                    <div class="form-section">
                        <div class="section-title">{{ $content['formHeading']  }}</div>
                        
                        <form method="POST" action="{{ route('contact.form.submission') }}">
                            @csrf
                            
                            @if(session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif
                            
                            <div class="mb-4">
                                <label>Name</label>
                                <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" placeholder="Name">
                                @error('name') <p class="text-danger mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div class="mb-4">
                                <label>Email</label>
                                <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" placeholder="Email">
                                @error('email') <p class="text-danger mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div class="mb-4">
                                <label>Phone Number</label>
                                <input type="text" name="phone" value="{{ old('phone') }}" class="form-control @error('phone') is-invalid @enderror" placeholder="Phone number">
                                @error('phone') <p class="text-danger mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div class="mb-4">
                                <label>Special Instructions</label>
                                <textarea name="instructions" class="form-control @error('instructions') is-invalid @enderror" placeholder="Special Instructions" rows="5">{{ old('instructions') }}</textarea>
                                @error('instructions') <p class="text-danger mt-1">{{ $message }}</p> @enderror
                            </div>

                            <input type="text" name="website" style="display:none">

                             <div class="mb-3">
                                {!! NoCaptcha::display(['data-callback' => 'enableSubmit']) !!}
                                @error('g-recaptcha-response')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mt-4 d-flex flex-row gap-3 sh-custom-mt-xxl">
                                <button disabled id="contact_form_submission_btn" type="submit" class="btn-yellow" onclick="$('#sh-loader').removeClass('d-none')">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-4">
                    <h2 class="section-title">{{ $content['sectionTitle'] }}</h2>
                </div>
                <div class="contact-content">
                    @foreach ($content['contactMethods'] as $method)
                        <div class="my-4">
                            <h4>{{ $method['title'] }}</h4>
                            @foreach($method['description'] as $detail)
                            <p>{!! replace_shortcodes($detail) !!}</p>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endsection