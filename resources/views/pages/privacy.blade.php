@extends('layouts.main.mainLayout')

@section('title', 'Privacy Policy | Swizchem Data Protection & GDPR Compliance')
@section('meta_description', 'Learn how Swizchem collects, uses, and protects your data in compliance with GDPR. Read about your rights, our cookie policy, and data retention practices.')
@section('meta_keywords', 'Swizchem privacy policy, GDPR compliance, data protection, cookies, personal information, user rights, data usage, data security, privacy rights')

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
            <div class="contact-block col-12">
                @foreach ($contact as $contactKey => $contactValue)
                    <h4>{!! $contactKey !!}</h4>
                    <p>{!! replace_shortcodes($contactValue) !!}</p>
                @endforeach
            </div>
        </div>
    </div>
</section>

@endsection