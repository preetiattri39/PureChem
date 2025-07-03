@extends('layouts.main.mainLayout')

@section('title', 'Checkout | Swizchem')
@section('robots', 'noindex, nofollow')

@section('vite')
    @vite(['resources/js/pages/checkout.js', 'resources/css/pages/checkout.css'])
@endsection

@section('content')

<!-- Hero Section -->
<section class="inner-hero sh-custom-bg-light align-items-center">
    <div class="container">
        <h1 class="display-5 fw-bold">Checkout</h1>
    </div>
</section>
<!-- Products Section -->
<section class="py-5">
    <!-- Main Content -->
    <div class="container pb-5">
        <div class="row g-5">
            <!-- Sidebar -->
            <div class="col-md-3">
                <div class="sidebar">
                    <h5>Category</h5>
                    <ul class="d-flex flex-column gap-3 list-unstyled">
                        <li><a href="#">Advanced Intermediates</a></li>
                        <li><a href="#">Fine Chemicals</a></li>
                        <li><a href="#">Isotope Labeled</a></li>
                        <li><a href="#">Metabolites & Impurities</a></li>
                        <li><a href="#">Natural Products</a></li>
                        <li><a href="#">OLED</a></li>
                        <li><a href="#">Peptides</a></li>
                        <li><a href="#">Reagents & Ligands</a></li>
                        <li><a href="#">Featured Products</a></li>
                        <li><a href="#">Complete Product List</a></li>
                    </ul>
                </div>
            </div>
            <!-- Product List -->
            <div class="col-md-9">
                <div class="mb-3">
                    <h3 class="fw-bold sh-custom-text-accent">RFQ Form</h3>
                    <p>To continue please fill out the following form.</p>
                </div>
                <div class="row g-4">
                    <div class="col-md-8">
                        <div class="form-wrap">
                            <div class="form-section">
                                <div class="section-title">Enter the address details</div>
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
                                    <div class="row">
                                        <div class="col-md-6 mb-4">
                                            <label>City</label>
                                            <input type="text" class="form-control" placeholder="City name">
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <label>Country</label>
                                            <select class="form-select">
                                                <option>USA</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-4">
                                            <label>Company/ Organization</label>
                                            <input type="text" class="form-control" placeholder="Company/Organization name">
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <label>Purpose</label>
                                            <select class="form-select">
                                                <option>Purpose</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-4">
                                            <label>Province</label>
                                            <select class="form-select">
                                                <option>Alabama</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <label>Postal Code</label>
                                            <input type="text" class="form-control" placeholder="Postal Code">
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <label>Special Instructions</label>
                                        <textarea class="form-control" placeholder="Special Instructions" rows="3"></textarea>
                                    </div>
                                </form>
                            </div>
                            <div class="form-section">
                                <div class="section-title">Save time on your next RFQ. Check the box to create an account</div>
                                <div class="form-check mb-3 p-3">
                                    <input class="form-check-input" type="checkbox" id="createAccount">
                                    <label class="form-check-label" for="createAccount">Create Account</label>
                                </div>
                            </div>
                            <div class="mt-4 d-flex flex-row gap-3 sh-custom-mt-xxl">
                                <button class="btn-yellow">Submit</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-wrap">
                            <div class="form-section">
                                <div class="section-title">Already have an account?</div>
                                <form>
                                    <div class="mb-4">
                                        <label>Email</label>
                                        <input type="email" class="form-control" placeholder="Email">
                                    </div>
                                    <div class="mb-4">
                                        <label>Password</label>
                                        <input type="password" class="form-control" placeholder="Password">
                                    </div>
                                    <button class="btn-yellow">Login</button>
                                </form>
                            </div>
                        </div>
                        <div class="form-wrap">
                            <div class="form-section">
                                <div class="section-title">Forget Your Password?</div>
                                <form>
                                    <div class="mb-4">
                                        <label>Email</label>
                                        <input type="email" class="form-control" placeholder="Email">
                                    </div>
                                    <button class="btn-yellow">Get Password</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection