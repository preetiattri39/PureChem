@extends('layouts.main.mainLayout')

@section('title', 'Swizchem | Custom Synthesis, Peptides, Intermediates & Research Chemicals')
@section('meta_description', 'Swizchem is a trusted partner for high-purity chemicals, custom synthesis, peptides, advanced intermediates, and research-grade reagents.')
@section('meta_keywords', 'Swizchem, custom synthesis, peptide synthesis, oligopeptides, reagents, research chemicals, advanced intermediates, CAS search, pharmaceutical impurities')

{{-- Open Graph for Facebook/LinkedIn --}}
@section('og_title', View::getSection('title'))
@section('og_description', View::getSection('meta_description'))

{{-- Twitter Card --}}
@section('twitter_title', View::getSection('title'))
@section('twitter_description', View::getSection('meta_description'))


@section('vite')
    @vite(['resources/js/pages/home.js', 'resources/css/pages/home.css'])
@endsection

@section('content')

<!-- Hero Section -->
<section class="hero">
    <div class="container">
        <div class="col-12 text-center mb-5">
            <a href="{{ route('custom-synthesis') }}" class="btn-yellow">{!! $content['heroBannerButtonText'] !!}</a>
        </div>
        <x-chemical-search
            title="Chemical Catalog - Complete Products List"
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
            @foreach($content['serviceCards'] as $card)
            <div class="service-card col-6 custom-col-20">
                <div class="icon-box sh-custom-bg-light">
                    <img src="{!! asset($card['icon']) !!}" class="mb-2">
                    <p class="fw-bold mb-1">{!! $card['title'] !!}</p>
                    <small class="mb-3">{!! $card['description'] !!}</small>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Detail Sections -->
<section class="py-5">
    <div class="container">
        @foreach ($content['contentSections'] as $section)
            <div class="row align-items-center g-5 mb-5">
                @if ($loop->iteration % 2 !== 0)
                    <div class="col-md-6">
                        <picture>
                            <source srcset="{{ asset($section['images']['3x']) }}" media="(min-width: 992px)">
                            <source srcset="{{ asset($section['images']['2x']) }}" media="(min-width: 768px)">
                            <img src="{{ asset($section['images']['1x']) }}" alt="{{ $section['title'] }}" class="img-fluid rounded">
                        </picture>
                    </div>
                    <div class="col-md-6">
                        <h2 class="section-title">{!! $section['title'] !!}</h2>
                        <p>{!! $section['description'] !!}</p>
                        <a href="#" class="btn-yellow mt-3">{!! $section['learnMoreButtonText'] !!}</a>
                    </div>
                @else
                    <div class="col-md-6">
                        <h2 class="section-title">{!! $section['title'] !!}</h2>
                        <p>{!! $section['description'] !!}</p>
                        <a href="#" class="btn-yellow mt-3">{!! $section['learnMoreButtonText'] !!}</a>
                    </div>
                    <div class="col-md-6">
                        <picture>
                            <source srcset="{{ asset($section['images']['3x']) }}" media="(min-width: 992px)">
                            <source srcset="{{ asset($section['images']['2x']) }}" media="(min-width: 768px)">
                            <img src="{{ asset($section['images']['1x']) }}" alt="{{ $section['title'] }}" class="img-fluid rounded">
                        </picture>
                    </div>
                @endif
            </div>
        @endforeach
    </div>
</section>
@endsection