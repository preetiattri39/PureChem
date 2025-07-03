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
    @vite(['resources/js/pages/conatact.js', 'resources/css/pages/contact.css'])
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
                        <form>
                            <div class="mb-4">
                                <label>Name</label>
                                <input type="text" class="form-control" placeholder="Name">
                            </div>
                            <div class="mb-4">
                                <label>Email</label>
                                <input type="email" class="form-control" placeholder="Email">
                            </div>
                            <div class="mb-4">
                                <label>Phone Number</label>
                                <input type="text" class="form-control" placeholder="Phone number">
                            </div>
                            <div class="mb-4">
                                <label>Special Instructions</label>
                                <textarea class="form-control" placeholder="Special Instructions" rows="5"></textarea>
                            </div>
                            <div class="mt-4 d-flex flex-row gap-3 sh-custom-mt-xxl">
                                    <button class="btn-yellow">Submit</button>
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