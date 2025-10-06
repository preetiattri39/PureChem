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
        <h1 class="display-5 fw-bold">Company</h1>
    </div>
</section>

<!-- Mission Statement -->
<section class="py-5">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-md-6">
                <h2 class="section-title">Mission statement</h2>
                <p>Swizchem is committed to the dependable supply and precision-driven custom synthesis of high-quality chemical compounds. We uphold uncompromising standards in chemical purity, safety, and application integrity to ensure the success of our partners across the scientific spectrum. Serving academic institutions, industrial innovators, and cutting-edge research facilities, we aim to be more than just a supplier—we strive to be a trusted collaborator. By fostering responsible innovation, ethical chemical practices, and sustainable progress, Swizchem supports the pursuit of scientific excellence with every molecule delivered. At Swizchem we believe in ”<b>Chemistry with care</b>”.</p>
            </div>
            <div class="col-md-6">
                <picture>
                    <source srcset="{{ asset('images/web/mission-statement-3x.webp') }}" media="(min-width: 992px)">
                    <source srcset="{{ asset('images/web/mission-statement-2x.webp') }}" media="(min-width: 768px)">
                    <img src="{{ asset('images/web/mission-statement-2x.webp') }}" alt="Mission statement" class="img-fluid rounded" loading="lazy">
                </picture>
            </div>
        </div>
    </div>
</section>

<!-- Privacy -->
<section class="py-5 sh-custom-bg-light">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-md-6">
                <picture>
                    <source srcset="{{ asset('images/web/privacy-3x.webp') }}" media="(min-width: 992px)">
                    <source srcset="{{ asset('images/web/privacy-2x.webp') }}" media="(min-width: 768px)">
                    <img src="{{ asset('images/web/privacy-2x.webp') }}" alt="Privacy" class="img-fluid rounded" loading="lazy">
                </picture>
            </div>
            <div class="col-md-6">
                <h2 class="section-title">Privacy</h2>
                <p>We value your privacy and only collect essential data to improve our services. Your information is handled securely and in compliance with GDPR.</p>
                <a href="{{ route('privacy') }}" class="btn-yellow mt-5">View Privacy Policy</a>
            </div>
        </div>
    </div>
</section>

<!-- Confidentiality -->
<section class="py-5">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-md-6">
                <h2 class="section-title">Confidentiality</h2>
                <p>Swizchem is committed to safeguarding all proprietary, technical, and commercial information shared with us. Whether under a mutual or one-way agreement, we treat such data with strict confidentiality and use it solely for its intended purpose. In return, we expect clients to maintain the same level of confidentiality regarding Swizchem’s proprietary information, ensuring a foundation of trust and professional integrity.</p>
                <a href="{{ route('confidentiality') }}" class="btn-yellow mt-5">View confidentiality contract</a>
            </div>
            <div class="col-md-6">
                <picture>
                    <source srcset="{{ asset('images/web/confidentially-3x.webp') }}" media="(min-width: 992px)">
                    <source srcset="{{ asset('images/web/confidentially-2x.webp') }}" media="(min-width: 768px)">
                    <img src="{{ asset('images/web/confidentially-2x.webp') }}" alt="Confidentiality" class="img-fluid rounded" loading="lazy">
                </picture>
            </div>
        </div>
    </div>
</section>

<!-- Business Strategy -->
<section class="py-5 sh-custom-bg-light">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-md-6">
                <picture>
                    <source srcset="{{ asset('images/web/business-strategy-3x.webp') }}" media="(min-width: 992px)">
                    <source srcset="{{ asset('images/web/business-strategy-2x.webp') }}" media="(min-width: 768px)">
                    <img src="{{ asset('images/web/business-strategy-2x.webp') }}" alt="Business Strategy" class="img-fluid rounded" loading="lazy">
                </picture>
            </div>
            <div class="col-md-6">
                <h2 class="section-title">Business Strategy</h2>
                <p>At Swizchem, our strategy is shaped by a commitment to sustainable growth, scientific excellence, and lasting partnerships. We envision a future where innovation in chemistry benefits not only industries but also communities and the environment. Guided by core values of integrity, fairness, and responsibility, we aim to build a business that thrives on trust and thoughtful progress.<br><br>In a competitive landscape, our focus remains sharp: delivering specialized chemical solutions with unmatched quality and a human-centered approach. We serve niche markets with precision—understanding their evolving needs and responding with tailored, ethical solutions.<br><br>Our growth is driven by clear goals—enhancing capabilities, expanding reach, and establishing infrastructure that strengthens our promise to clients. Through strategic focus, trusted alliances, and continuous improvement, we are building a resilient path forward—where excellence meets accountability.</p>
                <a href="{{ route('business.strategy') }}" class="btn-yellow mt-5">View Our Business Strategy</a>
            </div>
        </div>
    </div>
</section>

@endsection
