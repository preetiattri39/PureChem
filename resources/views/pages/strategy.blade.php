@extends('layouts.main.mainLayout')

@section('title', 'Business Strategy | Swizchem Vision, Values & Scientific Growth')
@section('meta_description', 'Discover Swizchem’s business strategy focused on ethical chemistry, sustainability, niche market insight, and purposeful partnerships that drive scientific impact.')
@section('meta_keywords', 'Swizchem business strategy, ethical chemistry, scientific innovation, sustainable growth, research partnerships, R&D expansion, chemistry company vision')

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
    <div class="container text-center">
        <h1 class="display-6 fw-bold">{{ $hero['title'] }}</h1>
         <p class="w-5 mt-3 col-md-6 offset-md-3 text-center">{{ $hero['description'] }}</p>
    </div>
</section>

<!-- Details Sections -->
<section class="py-5">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-12 flex-col items-center"> 
                @foreach ($details as $detailKey => $detailValue)
                <div class="details-block">
                    <h4>{!! $detailKey !!}</h4>
                    @foreach ($detailValue as $value)
                        <p>{!! $value !!}</p>
                    @endforeach
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

@endsection