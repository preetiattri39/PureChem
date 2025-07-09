@extends('layouts.main.mainLayout')

@section('title', 'About Swizchem | Mission, Privacy & Business Strategy')
@section('meta_description', 'Explore Swizchem’s mission, commitment to privacy, confidentiality standards, and strategic vision in ethical chemical solutions.')
@section('meta_keywords', 'Swizchem, chemical company, mission statement, privacy policy, confidentiality agreement, sustainable strategy, custom synthesis, research chemicals')

{{-- Open Graph for Facebook/LinkedIn --}}
@section('og_title', View::getSection('title'))
@section('og_description', View::getSection('meta_description'))

{{-- Twitter Card --}}
@section('twitter_title', View::getSection('title'))
@section('twitter_description', View::getSection('meta_description'))

@section('vite')
    @vite([])
@endsection

@section('content')

<!-- Hero Section -->
<section class="inner-hero sh-custom-bg-light align-items-center">
    <div class="container">
        <h1 class="display-5 fw-bold">{!! $content['heroTitle'] !!}</h1>
    </div>
</section>

<!-- Dynamic Sections -->
@foreach ($content['sections'] as $index => $section)
    <section class="py-5 {{ $index % 2 === 1 ? 'sh-custom-bg-light' : '' }}">
        <div class="container">
            <div class="row align-items-center g-5">
                @if ($index % 2 === 0)
                    <div class="col-md-6">
                        <h2 class="section-title">{!! $section['title'] !!}</h2>
                        <p>{!! $section['description'] !!}</p>
                        @if (!empty($section['linkText']))
                            <a href="{!! route($section['link']) !!}" class="btn-yellow mt-5">{!! $section['linkText'] !!}</a>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <picture>
                            <source srcset="{{ asset($section['image']['3x']) }}" media="(min-width: 992px)">
                            <source srcset="{{ asset($section['image']['2x']) }}" media="(min-width: 768px)">
                            <img src="{{ asset($section['image']['1x']) }}" alt="{!! $section['title'] !!}" class="img-fluid rounded">
                        </picture>
                    </div>
                @else
                    <div class="col-md-6">
                        <picture>
                            <source srcset="{{ asset($section['image']['3x']) }}" media="(min-width: 992px)">
                            <source srcset="{{ asset($section['image']['2x']) }}" media="(min-width: 768px)">
                            <img src="{{ asset($section['image']['1x']) }}" alt="{!! $section['title'] !!}" class="img-fluid rounded">
                        </picture>
                    </div>
                    <div class="col-md-6">
                        <h2 class="section-title">{!! $section['title'] !!}</h2>
                        <p>{!! $section['description'] !!}</p>
                        @if (!empty($section['linkText']))
                            <a href="{!! route($section['link']) !!}" class="btn-yellow mt-5">{!! $section['linkText'] !!}</a>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </section>
@endforeach
@endsection
