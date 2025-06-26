@extends('layouts.main.mainLayout')
@section('title', 'Swizchem - Where Research Meets Reliable Chemistry')

@section('vite')
    @vite(['resources/js/pages/home.js', 'resources/css/pages/home.css'])
@endsection

@section('content')

<!-- Hero Section -->
<section class="hero" style="background: url('images/web/swizchem-banner.jpg');">
    <div class="container">
        <div class="col-12 text-center mb-5">
            <button class="btn-yellow">{!! $content['heroBannerButtonText'] !!}</button>
        </div>
        <div class="col-12 d-flex flex-column justify-content-center align-items-center gap-4">
            <h1 class="display-4 fw-bold col-6 text-center">{!! $content['heroBannerTitle'] !!}</h1>
            <form class="d-flex justify-content-center col-6 position-relative search-form">
                <input type="text" class="form-control" placeholder="{!! $content['heroBannerSearchPlaceholder'] !!}" />
                <button class="btn-yellow form-btn">{!! $content['heroBannerSearchButtonText'] !!}</button>
            </form>
        </div>
    </div>
</section>

<!-- Service Cards -->
<section class="py-5">
    <div class="container">
        <div class="row g-3">
            @foreach($content['serviceCards'] as $card)
            <div class="col-6 custom-col-20">
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
                            <source srcset="{{ asset($section['images']['3x']) }}" media="(min-width: 1200px)">
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
                            <source srcset="{{ asset($section['images']['3x']) }}" media="(min-width: 1200px)">
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