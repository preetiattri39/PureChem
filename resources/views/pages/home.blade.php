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
<section class="hero">
    <div class="container">
        <div class="hero-shell">
            <div class="hero-copy">
                <span class="hero-kicker">Research Supply Platform</span>
                <h1>Where Research Meets Reliable Chemistry</h1>
                <p class="hero-lead">
                    Discover catalog compounds faster, move custom synthesis requests forward with less friction,
                    and source research-grade materials from a team built around precision and delivery confidence.
                </p>
                <div class="hero-actions">
                    <a href="{{ route('custom-synthesis') }}" class="btn-yellow">Start a Custom Proposal</a>
                    <a href="{{ route('products.main') }}" class="btn-outline-light">Browse Catalog</a>
                </div>
                <div class="hero-points">
                    <span>High-purity compounds</span>
                    <span>Transparent RFQ workflow</span>
                    <span>Research-focused sourcing</span>
                </div>
            </div>

            <div class="hero-discovery">
                <div class="hero-search-card">
                    <x-chemical-search
                        title="Search the catalog by<br /> chemical name, CAS, or formula"
                        placeholder="Search by chemical name or CAS"
                        :action="route('products.main')"
                        method="GET"
                        button-text="Search"
                        :form-value="request('search')"
                        required=true
                    />
                </div>

                <div class="hero-stats-grid">
                    <div class="hero-stat-card">
                        <strong>{{ number_format($catalogStats['products']) }}+</strong>
                        <span>catalog products</span>
                    </div>
                    <div class="hero-stat-card">
                        <strong>{{ number_format($catalogStats['categories']) }}</strong>
                        <span>active categories</span>
                    </div>
                    <div class="hero-stat-card">
                        <strong>{{ number_format($catalogStats['cas_records']) }}+</strong>
                        <span>CAS-indexed records</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 services-section">
    <div class="container">
        <div class="section-heading-row">
            <div>
                <span class="section-eyebrow">Core capabilities</span>
                <h2 class="section-title mb-0">Built for discovery, sourcing, and scale-up</h2>
            </div>
            <p class="section-intro mb-0">
                The homepage now highlights the workstreams customers care about most: fast catalog search,
                synthesis support, and a clearer path into quoting and fulfillment.
            </p>
        </div>

        <div class="row g-3">
            <div class="service-card col-12 col-sm-6 custom-col-20">
                <div class="icon-box sh-custom-bg-light">
                    <img src="{{ asset('images/icons/amino-acids.svg') }}" class="mb-2" alt="Amino acids icon">
                    <p class="fw-bold mb-1">Amino Acids for Peptide Synthesis</p>
                    <small>Protected and specialty building blocks for peptide programs.</small>
                </div>
            </div>

            <div class="service-card col-12 col-sm-6 custom-col-20">
                <div class="icon-box sh-custom-bg-light">
                    <img src="{{ asset('images/icons/oligopeptides.svg') }}" class="mb-2" alt="Oligopeptides icon">
                    <p class="fw-bold mb-1">Oligopeptides</p>
                    <small>Flexible sourcing for screening, analytical, and reference needs.</small>
                </div>
            </div>

            <div class="service-card col-12 col-sm-6 custom-col-20">
                <div class="icon-box sh-custom-bg-light">
                    <img src="{{ asset('images/icons/advanced.svg') }}" class="mb-2" alt="Advanced intermediates icon">
                    <p class="fw-bold mb-1">Advanced Intermediates</p>
                    <small>Complex intermediates aligned to medicinal chemistry timelines.</small>
                </div>
            </div>

            <div class="service-card col-12 col-sm-6 custom-col-20">
                <div class="icon-box sh-custom-bg-light">
                    <img src="{{ asset('images/icons/metabolites.svg') }}" class="mb-2" alt="Metabolites icon">
                    <p class="fw-bold mb-1">Metabolites And Impurities</p>
                    <small>Reference materials for method development and validation work.</small>
                </div>
            </div>

            <div class="service-card col-12 col-sm-6 custom-col-20">
                <div class="icon-box sh-custom-bg-light">
                    <img src="{{ asset('images/icons/reagents.svg') }}" class="mb-2" alt="Reagents icon">
                    <p class="fw-bold mb-1">Reagents And Ligands</p>
                    <small>Research-grade reagents selected for reliable synthesis workflows.</small>
                </div>
            </div>
        </div>
    </div>
</section>

@if($topCategories->isNotEmpty())
<section class="py-5 category-explorer">
    <div class="container">
        <div class="section-heading-row">
            <div>
                <span class="section-eyebrow">Catalog intelligence</span>
                <h2 class="section-title mb-0">Explore high-signal categories</h2>
            </div>
            <a href="{{ route('products.main') }}" class="btn-outline-yellow">View full catalog</a>
        </div>

        <div class="row g-4">
            @foreach($topCategories as $category)
                <div class="col-12 col-md-6">
                    <a href="{{ route('products.category', ['id' => $category->id]) }}" class="category-spotlight">
                        <div>
                            <span class="category-count">{{ number_format($category->products_count) }} products</span>
                            <h3>{{ $category->name }}</h3>
                            <p>{{ $category->description ?: 'Curated compounds and related materials for active research programs. ' }}</p>
                        </div>
                        <span class="category-link">Open category</span>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@if($featuredProducts->isNotEmpty())
<section class="py-5 featured-products-section">
    <div class="container">
        <div class="section-heading-row">
            <div>
                <span class="section-eyebrow">Fresh inventory</span>
                <h2 class="section-title mb-0">Featured compounds from the catalog</h2>
            </div>
            <p class="section-intro mb-0">
                Recent additions are surfaced directly on the homepage so buyers can move from discovery to detail in fewer clicks.
            </p>
        </div>

        <div class="row g-3">
            @foreach($featuredProducts as $product)
                <x-product-card :product="$product" />
            @endforeach
        </div>
    </div>
</section>
@endif

<section class="py-5 company-sections">
    <div class="container">
        <div class="delivery-track">
            <div class="delivery-step">
                <span>01</span>
                <h3>Search and shortlist</h3>
                <p>Use CAS, name, and formula-based discovery to reach relevant compounds quickly.</p>
            </div>
            <div class="delivery-step">
                <span>02</span>
                <h3>Request custom work</h3>
                <p>Route synthesis needs into a structured proposal flow with clear research context.</p>
            </div>
            <div class="delivery-step">
                <span>03</span>
                <h3>Quote and fulfill</h3>
                <p>Move approved demand into quotation, ordering, and invoice workflows already present in the app.</p>
            </div>
        </div>

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

        <div class="row align-items-center g-5 mb-5">
            <div class="col-md-6">
                <h2 class="section-title">Custom Synthesis</h2>
                <p>
                    Swizchem offers tailored synthesis solutions designed to accelerate discovery and development.
                    Whether you need rare compounds, reference standards, metabolites, or scalable quantities of advanced
                    intermediates, our team of expert chemists delivers with speed and precision. We collaborate closely with
                    clients to design efficient, cost-effective synthetic routes while maintaining strict confidentiality
                    and quality standards. From milligrams to kilograms, we turn your molecular vision into reality.
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
