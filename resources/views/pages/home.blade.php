@extends('layouts.main.mainLayout')
@section('title', 'Welcome')

@section('vite')
    @vite(['resources/js/pages/home.js', 'resources/css/pages/home.css'])
@endsection

@section('content')

<!-- Hero Section -->
<section class="hero" style="background: url('images/web/swizchem-banner.jpg');">
    <div class="container">
        <div class="col-12 text-center mb-5">
            <button class="btn-yellow">Custom Proposal – Start Here</button>
        </div>
        <div class="col-12 d-flex flex-column justify-content-center align-items-center gap-4">
            <h1 class="display-4 fw-bold col-6 text-center">Where Research Meets<br>Reliable Chemistry</h1>
            <form class="d-flex justify-content-center col-6 position-relative search-form">
                <input type="text" class="form-control" placeholder="Search by chemical name or CAS" />
                <button class="btn-yellow form-btn">Search</button>
            </form>
        </div>
    </div>
</section>

<!-- Product Categories -->
<section class="py-5">
    <div class="container">
        <div class="row g-3">
            <div class="col-6 custom-col-20">
                <div class="icon-box sh-custom-bg-light">
                    <img src="{{ asset('images/icons/amino-acids.svg') }}" class="mb-2">
                    <p class="fw-bold mb-1">Amino Acids<br>for Peptide Synthesis</p>
                    <small class="mb-3">Lorem Ipsum is dummy text.</small>
                </div>
            </div>
            <div class="col-6 custom-col-20">
                <div class="icon-box sh-custom-bg-light">
                    <img src="{{ asset('images/icons/oligopeptides.svg') }}" class="mb-2">
                    <p class="fw-bold mb-1">Oligopeptides</p>
                    <small class="mb-3">Lorem Ipsum is dummy text.</small>
                </div>
            </div>
            <div class="col-6 custom-col-20">
                <div class="icon-box sh-custom-bg-light">
                    <img src="{{ asset('images/icons/advanced.svg') }}" class="mb-2">
                    <p class="fw-bold mb-1">Advanced Intermediates</p>
                    <small class="mb-3">Lorem Ipsum is dummy text.</small>
                </div>
            </div>
            <div class="col-6 custom-col-20">
                <div class="icon-box sh-custom-bg-light">
                    <img src="{{ asset('images/icons/metabolites.svg') }}" class="mb-2">
                    <p class="fw-bold mb-1">Metabolites And Impurities</p>
                    <small class="mb-3">Lorem Ipsum is dummy text.</small>
                </div>
            </div>
            <div class="col-6 custom-col-20">
                <div class="icon-box sh-custom-bg-light">
                    <img src="{{ asset('images/icons/reagents.svg') }}" class="mb-2">
                    <p class="fw-bold mb-1">Reagents And Ligands</p>
                    <small class="mb-3">Lorem Ipsum is dummy text.</small>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Company Section -->
<section class="py-5">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-md-6">
                <img src="{{ asset('images/web/Rectangle 26.jpg') }}" alt="Chemist" class="img-fluid rounded">
            </div>
            <div class="col-md-6">
                <h2 class="section-title">Company</h2>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. </p>
                <a href="#" class="btn-yellow mt-3">Learn More</a>
            </div>
        </div>
    </div>
</section>

<!-- Custom Synthesis Section -->
<section class="py-5">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-md-6">
                <h2 class="section-title">Custom Synthesis</h2>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. </p>
                <a href="#" class="btn-yellow mt-3">Learn More</a>
            </div>
            <div class="col-md-6">
                <img src="{{ asset('images/web/Rectangle 26 (1).jpg') }}" alt="Synthesis" class="img-fluid rounded">
            </div>
        </div>
    </div>
</section>
@endsection