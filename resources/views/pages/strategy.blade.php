@extends('layouts.main.mainLayout')

@section('title', 'Business Strategy | Swizchem Vision, Values & Scientific Growth')
@section('meta_description', 'Discover Swizchem’s business strategy focused on ethical chemistry, sustainability, niche market insight, and purposeful partnerships that drive scientific impact.')
@section('meta_keywords', 'Swizchem business strategy, ethical chemistry, scientific innovation, sustainable growth, research partnerships, R&D expansion, chemistry company vision')

{{-- Open Graph --}}
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
        <h1 class="display-6 fw-bold">Business Strategy</h1>
        <p class="w-5 mt-3 col-md-6 offset-md-3 text-center">
            Our Vision, Our Values, Our Path Forward
        </p>
    </div>
</section>

<!-- Details Sections -->
<section class="py-5">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-12 flex-col items-center">

                <div class="details-block">
                    <h4>Purpose</h4>
                    <p>
                        At Swizchem, our strategy stems from a vision of inclusive growth and scientific responsibility. 
                        Every step we take is anchored in loyalty, fairness, and long-term value. 
                        A sustainable future where science serves all.
                    </p>
                </div>

                <div class="details-block">
                    <h4>Core Principles</h4>
                    <p>o A foundation of trust and ethics</p>
                    <p>o 🔒 Integrity ⚖️ Fairness</p>
                    <p>o 🌱 Sustainability 🤝 Accountability</p>
                </div>

                <div class="details-block">
                    <h4>Focused Market Insight</h4>
                    <p>
                        Precision in niche service, chemistry with a human touch. 
                        We specialise in delivering bespoke solutions to institutions and industries 
                        that demand the highest standards in purity, ethics, and collaboration.
                    </p>
                </div>

                <div class="details-block">
                    <h4>Growth-Driven Strategy</h4>
                    <p>o Structured goals, measurable impact</p>
                    <p>o 📈 Revenue-Driven Planning</p>
                    <p>o 🧬 Lab & R&D Expansion</p>
                    <p>o 🤝 Partnerships with Purpose</p>
                    <p>o 📊 Continuous Performance Tracking</p>
                </div>

                <div class="details-block">
                    <h4>Vision in Motion</h4>
                    <p>
                        A future built on chemistry, care, and confidence. 
                        We are forging a path that aligns innovation with responsibility, science with society, and progress with purpose.
                    </p>
                </div>

            </div>
        </div>
    </div>
</section>

@endsection
