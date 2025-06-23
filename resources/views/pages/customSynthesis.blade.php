@extends('layouts.main.mainLayout')
@section('title', 'Welcome')

@section('vite')
    @vite(['resources/js/pages/synthesis.js', 'resources/css/pages/synthesis.css'])
@endsection

@section('content')

<!-- Hero Section -->
<section class="inner-hero bg-light align-items-center">
    <div class="container">
        <h1 class="display-6 fw-bold">Custom Chemistry, Precisely Delivered</h1>
        <p class="w-5 mt-3 col-md-6 offset-md-3 text-center">Tailored synthesis of small molecules, from milligram to gram scale — designed to meet your research, development, and quality needs.</p>
        <button class="btn btn-yellow mt-4">Request A Quote</button>
    </div>
</section>
<section class="py-5">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-md-6">
                <img src="{{ asset('images/web/what-we-offer.jpg') }}" alt="Chemist" class="img-fluid rounded">
            </div>
            <div class="col-md-6">
                <h6 class="subtitle">What We Offer</h6>
                <h2 class="section-title">Custom Molecules.<br> Designed for Discovery.</h2>
                <p>Swizchem offers high-quality custom synthesis services for small molecules across pharmaceutical, academic, and industrial sectors. Whether you need reference compounds, intermediates, or complex structures, we deliver with:</p>
                <ul>
                    <li>Milligram to gram scale synthesis</li>
                    <li>Confidential, made-to-order projects</li>
                    <li>Support for proprietary and non-commercial structures</li>
                    <li>Analytical data (NMR, HPLC, MS, COA) included</li>
                    <li>Timely delivery and full documentation</li>
                </ul>
            </div>
        </div>
    </div>
</section>
<section class="py-5">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-md-6">
                <h2 class="section-title">Who We Work With</h2>
                <p>Serving Scientists, Researchers, and Innovators</p>
                <p>Whether you're advancing drug discovery, scaling a lead compound, or exploring a novel scaffold — we’re your synthesis partner.</p>
                <h6 class="subtitle">Our clients include</h6>
                <p class="fw-bold">Academic institutions & postdoctoral researchers</p>
                <p class="fw-bold">Biotech and pharmaceutical R&D labs</p>
                <p class="fw-bold">CROs and startups</p>
                <p class="fw-bold">Chemical sourcing managers</p>
            </div>
            <div class="col-md-6">
                <img src="{{ asset('images/web/what-we-offer.jpg') }}" alt="Chemist" class="img-fluid rounded">
            </div>
        </div>
    </div>
</section>
<section class="py-5 bg-light">
    <div class="container">
        <div class="row g-3 text-center">
            <h6 class="subtitle mb-0">Our Process</h6>
            <h2 class="section-title mb-5">How It Works</h2>
        </div>
        <div class="row g-3">
            <div class="col-6 col-md-2">
                <div class="icon-box">
                    <img src="{{ asset('images/icons/submit-request.svg') }}"" class="mb-2">
                    <p class="fw-bold mb-1">Submit your request</p>
                    <small class="mb-3">CAS number(if any), upload the structure, share the specs or project details</small>
                </div>
            </div>
            <div class="col-6 col-md-2">
                <div class="icon-box">
                    <img src="{{ asset('images/icons/feasibility-check.svg') }}"" class="mb-2">
                    <p class="fw-bold mb-1">Feasibility check</p>
                    <small class="mb-3">We'll evaluate and provide a quote</small>
                </div>
            </div>
            <div class="col-6 col-md-2">
                <div class="icon-box">
                    <img src="{{ asset('images/icons/synthesis.svg') }}"" class="mb-2">
                    <p class="fw-bold mb-1">Synthesis & QC</p>
                    <small class="mb-3">Handled by our expert chemists</small>
                </div>
            </div>
            <div class="col-6 col-md-2">
                <div class="icon-box">
                    <img src="{{ asset('images/icons/delivery.svg') }}"" class="mb-2">
                    <p class="fw-bold mb-1">Delivery</p>
                    <small class="mb-3">Product shipped with full analytical data</small>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="py-5">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-md-6">
                <img src="{{ asset('images/web/precision.jpg') }}" alt="Chemist" class="img-fluid rounded">
            </div>
            <div class="col-md-6">
                <h6 class="subtitle mb-0">Quality Assurance</h6>
                <h2 class="section-title">Precision You Can Trust</h2>
                <p>Every custom synthesis project is carried out under strict quality controls, with:</p>
                <ul>
                    <li>Full analytical characterization</li>
                    <li>COA and data transparency</li>
                    <li>Batch tracking and documentation</li>
                </ul>
            </div>
        </div>
    </div>
</section>
<section class="py-5">
    <div class="container">
        <div class="row g-3">
            <div class="col-md-6 offset-md-3">
                <div class="form-wrap">
                    <form id="multiStepForm">
                        <!-- Step 1 -->
                        <div class="step step-1">
                            <div class="row g-3 text-center mb-3">
                                <h6 class="subtitle mb-0">Get In Touch</h6>
                                <h2 class="section-title">Ready to Synthesize Your Next Compound?</h2>
                                <p class="text-center">Form with below details - Upload your structure, share your specs, and our chemists will follow up with a quote and lead time.</p>
                            </div>
                            <div class="form-section">
                                <div class="mb-4">
                                    <label for="molecule-name">Molecule name</label>
                                    <input type="text" class="form-control" placeholder="Molecule name">
                                </div>
                                <div class="mb-4">
                                    <label for="purity">Purity</label>
                                    <input type="text" class="form-control" placeholder="Purity">
                                </div>
                                <div class="mb-4">
                                    <label for="molecular-weight">Molecular weight</label>
                                    <input type="text" class="form-control" placeholder="Molecular weight">
                                </div>
                                <div class="mb-4">
                                    <label for="quantity">Quantity</label>
                                    <select class="form-select">
                                        <option>Quantity</option>
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <label for="special-instructions">Special Instructions</label>
                                    <textarea class="form-control" placeholder="Special Instructions" rows="3"></textarea>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label d-block">Structure Image Requirement?</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="structureRequired" id="structureYes" value="yes" checked>
                                        <label class="form-check-label" for="structureYes">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="structureRequired" id="structureNo" value="no">
                                        <label class="form-check-label" for="structureNo">No</label>
                                    </div>
                                </div>
                                <div id="structureFields">
                                    <div class="mb-3">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="uploadMethod" id="uploadImage" checked>
                                            <label class="form-check-label" for="uploadImage">Upload an image</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="uploadMethod" id="drawStructure">
                                            <label class="form-check-label" for="drawStructure">Draw the structure</label>
                                        </div>
                                    </div>
                                    <div class="mb-3 image-upload" onclick="document.getElementById('structureFile').click();">
                                        <input type="file" id="structureFile" hidden>
                                        <div>
                                            <img src="https://img.icons8.com/ios/50/image.png" alt="upload icon"/>
                                            <p class="mb-0">Image upload</p>
                                        </div>
                                    </div>
                                    <div class="canvas-container d-none">
                                        <canvas width="300" height="80" style="border:1px solid #E1E1E1;background: #E1E1E1;border-radius:20px" class="w-100"></canvas>
                                    </div>
                                </div>
                                <div class="mt-4 d-flex justify-content-end">
                                    <button type="button" class="btn btn-yellow" onclick="nextStep()">Next</button>
                                </div>
                            </div>
                        </div>
                        <!-- Step 2 -->
                        <div class="step step-2 d-none">
                            <div class="row g-3 text-center mb-3">
                                <h6 class="subtitle mb-0">Login or Register</h6>
                                <h2 class="section-title">Enter credentials to request for order</h2>
                                <p class="text-center">Please login with registered email if you already have an account with Swizchem. Do not have one, please register by selecting “No”. </p>
                            </div>
                            <div class="form-section">
                                <label class="form-label d-block">Existing Customer</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="existingCustomer" id="existingCustomerYes" value="yes" checked>
                                    <label class="form-check-label" for="existingCustomerYes">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="existingCustomer" id="existingCustomerNo" value="no">
                                    <label class="form-check-label" for="existingCustomerNo">No</label>
                                </div>
                                <!-- Shown when "Yes" is selected -->
                                <div id="existingCustomerFields" class="mb-4">
                                    <div class="mb-4">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" placeholder="Email">
                                    </div>
                                    <div class="mb-4">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" placeholder="Password">
                                    </div>
                                </div>
                                <!-- Shown when "No" is selected -->
                                <div id="newCustomerFields" class="d-none">
                                    <div class="mb-4">
                                        <label for="fullName">Name</label>
                                        <input type="text" class="form-control" placeholder="Name">
                                    </div>
                                    <div class="mb-4">
                                        <label for="newEmail">Email</label>
                                        <input type="email" class="form-control" placeholder="Email">
                                    </div>
                                    <div class="mb-4">
                                        <label for="phone">Phone Number</label>
                                        <input type="tel" class="form-control" placeholder="Phone Number">
                                    </div>
                                    <div class="mb-4">
                                        <label for="newPassword">Create Password</label>
                                        <input type="password" class="form-control" placeholder="Create Password">
                                    </div>
                                    <div class="mb-4">
                                        <label for="confirmPassword">Confirm Password</label>
                                        <input type="password" class="form-control" placeholder="Confirm Password">
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
                                </div>
                                <div class="d-flex justify-content-between mt-4">
                                    <button type="button" class="btn btn-primary" onclick="prevStep()">Back</button>
                                    <button type="submit" class="btn btn btn-yellow">Submit Order</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>    
        </div>
    </div>
</section>
@endsection