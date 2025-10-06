@extends('layouts.main.mainLayout')

@section('title', 'Swizchem | Custom Synthesis, Peptides, Intermediates & Research Chemicals')
@section('meta_description', 'Swizchem is a trusted partner for high-purity chemicals, custom synthesis, peptides, advanced intermediates, and research-grade reagents.')
@section('meta_keywords', 'Swizchem, custom synthesis, peptide synthesis, oligopeptides, reagents, research chemicals, advanced intermediates, CAS search, pharmaceutical impurities')

{{-- Open Graph --}}
@section('og_title', View::getSection('title'))
@section('og_description', View::getSection('meta_description'))

{{-- Twitter Card --}}
@section('twitter_title', View::getSection('title'))
@section('twitter_description', View::getSection('meta_description'))

@section('vite')
    @vite(['resources/css/pages/home.css'])
@endsection

@section('content')

<!-- Hero Section -->
<section class="hero">
    <div class="container">
        <div class="col-12 text-center mb-5">
            <a href="{{ route('custom-synthesis') }}" class="btn-yellow">Custom Proposal – Start Here</a>
        </div>

        <x-chemical-search
            title="Where Research Meets <br /> Reliable Chemistry"
            placeholder="Search by chemical name or CAS"
            :action="route('products.main')"
            method="GET"
            button-text="Search"
            :form-value="request('search')"
            required=true
        />
    </div>
</section>

<!-- Service Cards -->
<section class="py-5">
    <div class="container">
        <div class="row g-3">

            <div class="service-card col-6 custom-col-20">
                <div class="icon-box sh-custom-bg-light">
                    <img src="{{ asset('images/icons/amino-acids.svg') }}" class="mb-2">
                    <p class="fw-bold mb-1">Amino Acids for Peptide Synthesis</p>
                </div>
            </div>

            <div class="service-card col-6 custom-col-20">
                <div class="icon-box sh-custom-bg-light">
                    <img src="{{ asset('images/icons/oligopeptides.svg') }}" class="mb-2">
                    <p class="fw-bold mb-1">Oligopeptides</p>
                </div>
            </div>

            <div class="service-card col-6 custom-col-20">
                <div class="icon-box sh-custom-bg-light">
                    <img src="{{ asset('images/icons/advanced.svg') }}" class="mb-2">
                    <p class="fw-bold mb-1">Advanced Intermediates</p>
                </div>
            </div>

            <div class="service-card col-6 custom-col-20">
                <div class="icon-box sh-custom-bg-light">
                    <img src="{{ asset('images/icons/metabolites.svg') }}" class="mb-2">
                    <p class="fw-bold mb-1">Metabolites And Impurities</p>
                </div>
            </div>

            <div class="service-card col-6 custom-col-20">
                <div class="icon-box sh-custom-bg-light">
                    <img src="{{ asset('images/icons/reagents.svg') }}" class="mb-2">
                    <p class="fw-bold mb-1">Reagents And Ligands</p>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Detail Sections -->
<section class="py-5">
    <div class="container">

        <!-- Section 1 -->
        <div class="row align-items-center g-5 mb-5">
            <div class="col-md-6">
                <picture>
                    <source srcset="{{ asset('images/web/company-3x.webp') }}" media="(min-width: 992px)">
                    <source srcset="{{ asset('images/web/company-2x.webp') }}" media="(min-width: 768px)">
                    <img src="{{ asset('images/web/company-2x.webp') }}" alt="Company" class="img-fluid rounded" loading="lazy">
                </picture>
            </div>
            <div class="col-md-6">
                <h2 class="section-title">Company</h2>
                <p>
                    Swizchem, founded on a passion for precision and innovation, believes in delivering high-purity chemicals 
                    and research-grade reagents to scientists and industries worldwide. Headquartered in Helsinki, Finland, 
                    our commitment to quality, transparency, and scientific rigor positions us as a trusted partner for 
                    pharmaceutical, academic, and biotech research organisations. We have a team that drives remarkable 
                    breakthroughs in every molecule we touch.
                </p>
                <a href="{{ route('company') }}" class="btn-yellow mt-3">Learn More</a>
            </div>
        </div>

        <!-- Section 2 -->
        <div class="row align-items-center g-5 mb-5">
            <div class="col-md-6">
                <h2 class="section-title">Custom Synthesis</h2>
                <p>
                    Swizchem offers tailored synthesis solutions designed to accelerate discovery and development. 
                    Whether you need rare compounds, reference standards, metabolites, or scalable quantities of advanced 
                    intermediates, our team of expert chemists delivers with speed and precision. We collaborate closely with 
                    clients to design efficient, cost-effective synthetic routes while maintaining strict confidentiality 
                    and quality standards. From milligrams to kilograms—we turn your molecular vision into reality.
                </p>
                <a href="{{ route('custom-synthesis') }}" class="btn-yellow mt-3">Learn More</a>
            </div>
            <div class="col-md-6">
                <picture>
                    <source srcset="{{ asset('images/web/rectangle-3x.webp') }}" media="(min-width: 992px)">
                    <source srcset="{{ asset('images/web/rectangle-2x.webp') }}" media="(min-width: 768px)">
                    <img src="{{ asset('images/web/rectangle-2x.webp') }}" alt="Custom Synthesis" class="img-fluid rounded" loading="lazy">
                </picture>
            </div>
        </div>

    </div>
</section>

@endsection
