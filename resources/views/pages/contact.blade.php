@extends('layouts.main.mainLayout')
@section('title', 'Welcome')

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
                    <h2 class="contact-title fw-bold">{{ $content['formTitle']  }}</h2>
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
                    <h2 class="contact-title fw-bold">{{ $content['sectionTitle'] }}</h2>
                </div>
                <div class="contact-content">
                    @foreach ($content['contactMethods'] as $method)
                        <h4>{{ $method['title'] }}</h4>
                        <p class="mb-4">{!! $method['description'] !!}</p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endsection