@extends('layouts.main.mainLayout')
@section('title', 'Welcome')

@section('vite')
    @vite(['resources/js/pages/conatact.js', 'resources/css/pages/contact.css'])
@endsection

@section('content')

<!-- Hero Section -->
<section class="inner-hero sh-custom-bg-light align-items-center">
    <div class="container">
        <h1 class="display-5 fw-bold">Contact Us</h1>
    </div>
</section>
<section class="py-5 contact-page">
    <div class="container pb-5">
        <div class="row g-5">
            <div class="col-md-6">
                <div class="mb-4">
                    <h2 class="contact-title fw-bold">Have any suggestions or questions…</h2>
                </div>
                <div class="form-wrap">
                    <div class="form-section">
                        <div class="section-title">Enter the below details</div>
                        <form>
                            <div class="mb-4">
                                <label>Name</label>
                                <input type="text" class="form-control" placeholder="Name">
                            </div>
                            <div class="mb-4">
                                <label>Email</label>
                                <input type="email" class="form-control" placeholder="Email">
                            </div>
                            <div class="mb-4">
                                <label>Phone Number</label>
                                <input type="text" class="form-control" placeholder="Phone number">
                            </div>
                            <div class="mb-4">
                                <label>Special Instructions</label>
                                <textarea class="form-control" placeholder="Special Instructions" rows="5"></textarea>
                            </div>
                            <div class="mt-4 d-flex flex-row gap-3 sh-custom-mt-xxl">
                                    <button class="btn-yellow">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-4">
                    <h2 class="contact-title fw-bold">Other ways to reach out…</h2>
                </div>
                <div class="contact-content">
                    <h4>By Phone</h4>
                    <p class="mb-4"><span class="fw-bold">Swizchem </span>accepts telephone orders and enquiries between Monday to Thursday 9:00 AM - 3:30 PM ,
                        Friday 9:00 AM - 1:00 PM<br><br>
                        Ph +358 46 5534360</p>
                    <h4>By Online</h4>
                    <p class="mb-4">Customers can search for a product and request it by filling out the compound request form.<br>
                        Swizchem will get in touch within 24 hours.</p>
                    <h4>By Email</h4>
                    <p class="mb-4">sales@swizchem.com</p>
                    <h4>Customer support email</h4>
                    <p>manvatt@swizchem.com</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection