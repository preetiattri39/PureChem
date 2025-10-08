@extends('layouts.main.mainLayout')

@section('title', 'Contact Swizchem | Get in Touch with Our Team')
@section('meta_description', 'Reach out to Swizchem via phone, email, or our online form. We respond to product requests and inquiries within 24 hours.')
@section('meta_keywords', 'Contact Swizchem, Swizchem email, customer support, chemical inquiry, request quote, Swizchem phone number, compound request form')

{{-- Open Graph --}}
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
        <h1 class="display-5 fw-bold">Contact Us</h1>
    </div>
</section>

<section class="py-5 contact-page">
    <div class="container pb-5">
        <div class="row g-5">

            <!-- Contact Form -->
            <div class="col-md-6">
                <div class="mb-4">
                    <h2 class="section-title">Have any suggestions or questions?</h2>
                </div>
                <div class="form-wrap">
                    <div class="form-section">
                        <div class="section-title">Enter the below details</div>

                        <form class="p-0 py-3 px-md-4 py-md-4 " method="POST" action="{{ route('contact.form.submission') }}">
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

            <!-- Contact Methods -->
            <div class="col-md-6">
                <div class="mb-4">
                    <h2 class="section-title">Other ways to reach out</h2>
                </div>

                <div class="contact-content">

                    <!-- By Phone -->
                    <div class="my-4">
                        <h4>By Phone</h4>
                        <p><span class="fw-bold">Swizchem</span> accepts telephone orders and enquiries between:</p>
                        <p>{!! replace_shortcodes('[working-days-open]') !!} to {!! replace_shortcodes('[working-days-close]') !!} {!! replace_shortcodes('[working-hours-open]') !!} - {!! replace_shortcodes('[working-hours-close]') !!}</p>
                        <p>{!! replace_shortcodes('[exception-day-1]') !!} {!! replace_shortcodes('[exception-day-1-working-hours-open]') !!} - {!! replace_shortcodes('[exception-day-1-working-hours-close]') !!}</p>
                        <p>{!! replace_shortcodes('[admin-ph-1]') !!}</p>
                    </div>

                    <!-- By Online -->
                    <div class="my-4">
                        <h4>By Online</h4>
                        <p>Customers can search for a product and request it by filling out the compound request form.<br>Swizchem will get in touch within 24 hours.</p>
                    </div>

                    <!-- By Email -->
                    <div class="my-4">
                        <h4>By Email</h4>
                        <p><a href="mailto:{!! replace_shortcodes('[admin-email-1]') !!}">{!! replace_shortcodes('[admin-email-1]') !!}</a></p>
                    </div>

                    <!-- Customer Support Email -->
                    <div class="my-4">
                        <h4>Customer Support Email</h4>
                        <p><a href="mailto:{!! replace_shortcodes('[customer-support-email]') !!}">{!! replace_shortcodes('[customer-support-email]') !!}</a></p> 
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

@endsection
