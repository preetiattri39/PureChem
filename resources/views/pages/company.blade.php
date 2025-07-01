@extends('layouts.main.mainLayout')
@section('title', 'Welcome')

@section('vite')
    @vite(['resources/js/pages/company.js', 'resources/css/pages/company.css'])
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
                        <h2 class="section-title">{{ $section['title'] }}</h2>
                        <p>{{ $section['description'] }}</p>
                        @if (!empty($section['buttonText']))
                            <a href="#" class="btn-yellow mt-5">{{ $section['buttonText'] }}</a>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <img
                            src="{{ asset($section['image']['1x']) }}"
                            srcset="
                                {{ asset($section['image']['1x']) }} 1x,
                                {{ asset($section['image']['2x']) }} 2x,
                                {{ asset($section['image']['3x']) }} 3x
                            "
                            alt="{{ $section['title'] }}"
                            class="img-fluid rounded"
                        >
                    </div>
                @else
                    <div class="col-md-6">
                        <img
                            src="{{ asset($section['image']['1x']) }}"
                            srcset="
                                {{ asset($section['image']['1x']) }} 1x,
                                {{ asset($section['image']['2x']) }} 2x,
                                {{ asset($section['image']['3x']) }} 3x
                            "
                            alt="{{ $section['title'] }}"
                            class="img-fluid rounded"
                        >
                    </div>
                    <div class="col-md-6">
                        <h2 class="section-title">{{ $section['title'] }}</h2>
                        <p>{{ $section['description'] }}</p>
                        @if (!empty($section['buttonText']))
                            <a href="#" class="btn-yellow mt-5">{{ $section['buttonText'] }}</a>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </section>
@endforeach
@endsection
