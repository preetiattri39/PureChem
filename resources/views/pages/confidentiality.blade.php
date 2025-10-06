@extends('layouts.main.mainLayout')

@section('title', 'Mutual Confidentiality Statement | Swizchem')
@section('meta_description', 'Swizchem is committed to maintaining the highest standards of confidentiality and data protection under EU regulations, including GDPR. Learn about our mutual confidentiality policy, non-disclosure agreements, and data privacy commitments.')
@section('meta_keywords', 'Swizchem confidentiality, GDPR compliance, mutual NDA, non-disclosure agreement, client data protection, intellectual property confidentiality, data privacy, Swizchem legal policy')

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
        <h1 class="display-6 fw-bold">Mutual Confidentiality Statement</h1>
    </div>
</section>

<!-- Details Section -->
<section class="py-5">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-12 flex-col items-center"> 
                <div class="details-block mb-5">
                    <p>
                        At Swizchem, we are committed to maintaining the highest standards of confidentiality and data protection in compliance with European Union regulations, including the General Data Protection Regulation (GDPR) and relevant commercial confidentiality laws. 
                        This statement outlines our standard two-way confidentiality framework, applicable to all interactions involving chemical catalogue inquiries, custom synthesis services, or project-specific collaborations.
                    </p>
                </div>

                <div class="details-block mb-5">
                    <h4>Protection of Client Information</h4>
                    <p>Swizchem hereby undertakes to:</p>
                    <ul>
                        <li>Treat all technical, scientific, commercial, and personal data received from clients as confidential and proprietary.</li>
                        <li>Use such information solely for the purpose for which it was disclosed.</li>
                        <li>Not disclose, publish, reproduce, or otherwise make available any confidential information to third parties without the client’s explicit prior written consent.</li>
                        <li>Implement appropriate organizational and technical safeguards to protect client data, in accordance with GDPR.</li>
                    </ul>
                    <p>This includes information such as:</p>
                    <ul>
                        <li>Custom synthesis requirements</li>
                        <li>Product specifications or applications</li>
                        <li>Intellectual property details</li>
                        <li>Commercial terms and pricing</li>
                    </ul>
                </div>

                <div class="details-block mb-5">
                    <h4>Confidentiality of Swizchem’s Intellectual Property</h4>
                    <p>
                        Equally, clients agree to respect the confidentiality of Swizchem's proprietary materials, including but not limited to:
                    </p>
                    <ul>
                        <li>Synthesis methodologies</li>
                        <li>Proprietary formulations or data</li>
                        <li>Non-public product information</li>
                        <li>Project documentation and technical know-how</li>
                    </ul>
                    <p>
                        Such information remains the exclusive property of Swizchem and may not be disclosed, duplicated, reverse engineered, or used for purposes outside the scope of the agreed engagement.
                    </p>
                </div>

                <div class="details-block mb-5">
                    <h4>Mutual Non-Disclosure Agreement (NDA)</h4>
                    <p>
                        Prior to the exchange of sensitive information, Swizchem may require the execution of a Mutual Non-Disclosure Agreement (MNDA). This legally binding document will define:
                    </p>
                    <ul>
                        <li>The scope of confidentiality</li>
                        <li>Obligations and exclusions</li>
                        <li>Duration of the agreement</li>
                        <li>Remedies in the event of a breach</li>
                    </ul>
                    <p>
                        This ensures reciprocal legal protection and clarity on the responsibilities of both parties.
                    </p>
                </div>

                <div class="details-block mb-5">
                    <h4>Data Privacy Compliance (GDPR)</h4>
                    <p>
                        In accordance with GDPR, any personal data shared during our communications or collaborations is:
                    </p>
                    <ul>
                        <li>Processed lawfully, fairly, and transparently</li>
                        <li>Retained only for as long as necessary for the stated purpose</li>
                        <li>Accessible upon request for review, correction, or deletion</li>
                    </ul>
                    <p>
                        For further details, please refer to our <a href="{{ url('privacy') }}">Privacy Policy</a> available on our website.
                    </p>
                </div>

                <div class="details-block mb-5">
                    <h4>Legal Jurisdiction</h4>
                    <p>
                        All confidentiality agreements and data processing activities are governed by the applicable laws of the European Union and the jurisdiction in which Swizchem is registered. 
                        Disputes arising under confidentiality terms shall be resolved through amicable negotiation or, where necessary, through competent courts of law.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
