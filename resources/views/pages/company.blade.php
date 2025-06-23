@extends('layouts.main.mainLayout')
@section('title', 'Welcome')

@section('vite')
    @vite(['resources/js/pages/company.js', 'resources/css/pages/company.css'])
@endsection

@section('content')

<!-- Hero Section -->
<section class="inner-hero bg-light align-items-center">
    <div class="container">
        <h1 class="display-5 fw-bold">Company</h1>
    </div>
</section>

<!-- Mission statement Section -->
<section class="py-5">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-md-6">
                <h2 class="section-title">Mission statement</h2>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. </p>
            </div>
            <div class="col-md-6">
                <img src="{{ asset('images/web/mission-statement.jpg') }}" alt="Chemist" class="img-fluid rounded">
            </div>
        </div>
    </div>
</section>

<!-- Privacy Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-md-6">
                <img src="{{ asset('images/web/privacy.jpg') }}" alt="Synthesis" class="img-fluid rounded">
            </div>
            <div class="col-md-6">
                <h2 class="section-title">Privacy</h2>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. </p>
            </div>
        </div>
    </div>
</section>

<!-- Confidentiality Section -->
<section class="py-5">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-md-6">
                <h2 class="section-title">Confidentiality</h2>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                <a href="#" class="btn btn-yellow mt-5">View confidentiality contract</a>
            </div>
            <div class="col-md-6">
                <img src="{{ asset('images/web/confidentially.jpg') }}" alt="Chemist" class="img-fluid rounded">
            </div>
        </div>
    </div>
</section>

<!-- Business Strategy Section -->
<section class="py-5">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-md-6">
                <img src="{{ asset('images/web/business-strategy.jpg') }}" alt="Synthesis" class="img-fluid rounded">
            </div>
            <div class="col-md-6">
                <h2 class="section-title">Business Strategy</h2>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
            </div>
        </div>
    </div>
</section>

@endsection
