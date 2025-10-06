@extends('layouts.main.mainLayout')

@section('title', 'Privacy Policy | Swizchem Data Protection & GDPR Compliance')
@section('meta_description', 'Learn how Swizchem collects, uses, and protects your data in compliance with GDPR. Read about your rights, our cookie policy, and data retention practices.')
@section('meta_keywords', 'Swizchem privacy policy, GDPR compliance, data protection, cookies, personal information, user rights, data usage, data security, privacy rights')

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
        <h1 class="display-6 fw-bold">Privacy Policy</h1>
    </div>
</section>

<!-- Details Sections -->
<section class="py-5">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-12 flex-col items-center"> 

                <div class="details-block">
                    <h4>Data We Collect</h4>
                    <p>
                        We collect essential contact details including your name, email address and company information. 
                        Additionally, we may collect your order history, service preferences, and technical specifications to better tailor our offerings. 
                        Website usage data is also gathered through cookies, but only with your consent. 
                        All data is processed in full compliance with the General Data Protection Regulation (GDPR) 
                        and other relevant privacy laws.
                    </p>
                </div>

                <div class="details-block">
                    <h4>How We Use Your Data</h4>
                    <p>
                        Your data is used primarily to process inquiries and fulfill orders efficiently. 
                        We may also use it to communicate important updates, provide technical support, or notify you of any service changes. 
                        Moreover, data helps us improve the functionality and overall user experience of our website.
                    </p>
                </div>

                <div class="details-block">
                    <h4>Data Sharing and Retention</h4>
                    <p>
                        Swizchem does not sell, rent, or share personal data with third parties without explicit consent, 
                        except where required by law, or it is necessary to deliver services through trusted providers, 
                        such as payment processors or logistics partners. 
                        We retain your personal data only for as long as necessary to fulfill the purposes outlined 
                        in this policy or as required by applicable regulations.
                    </p>
                </div>

                <div class="details-block">
                    <h4>Your Rights Under GDPR</h4>
                    <p>
                        Under GDPR, you have the right to access, correct, or delete your personal data. 
                        You may also object to or restrict data processing and withdraw your consent at any time.
                    </p>
                </div>

                <div class="details-block">
                    <h4>Cookies</h4>
                    <p>
                        We use cookies to enhance your experience on our website and to analyze usage patterns. 
                        You will be asked to accept or decline cookies upon visiting our site. 
                        Cookie preferences can be managed at any time through your browser settings.
                    </p>
                </div>

                <div class="details-block">
                    <h4>Updates to This Policy</h4>
                    <p>
                        This privacy policy may be updated periodically to reflect changes in our practices or regulatory requirements.
                    </p>
                </div>

            </div>

            <div class="contact-block col-12">
                <h4>Contact Us</h4>
                <p>
                    If you have any questions regarding this privacy policy or your personal data, 
                    please feel free to contact us at <a href="mailto:sales@swizchem.com">sales@swizchem.com</a>.
                </p>
            </div>

        </div>
    </div>
</section>

@endsection
