@extends('layouts.main.mainLayout')

@section('title', 'Custom Synthesis Services | Small Molecule Chemistry by Swizchem')
@section('meta_description', 'Swizchem provides precision custom synthesis for small molecules, tailored for pharma, biotech, and academic research — with full analytical support.')
@section('meta_keywords', 'custom synthesis, small molecule synthesis, Swizchem synthesis, pharmaceutical intermediates, research chemicals, NMR HPLC MS COA, synthesis quote, CRO chemistry services')

{{-- Open Graph for Facebook/LinkedIn --}}
@section('og_title', View::getSection('title'))
@section('og_description', View::getSection('meta_description'))

{{-- Twitter Card --}}
@section('twitter_title', View::getSection('title'))
@section('twitter_description', View::getSection('meta_description'))

@section('vite')
    @vite(['resources/js/pages/synthesis.js', 'resources/css/pages/synthesis.css'])
@endsection

@section('head')
    {{-- Chemdoodle tool CSS and Script files --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/chemdoodle/chemdoodle-web.css') }}">
    <script src="{{ asset('js/chemdoodle/chemdoodle-web.js') }}"></script>
    <script src="{{ asset('js/chemdoodle/chemdoodle-web-uis.js') }}" ></script>
@endsection

@section('content')

<!-- Hero Section -->
<section class="inner-hero sh-custom-bg-light align-items-center">
    <div class="container text-center">
        <h1 class="display-6 fw-bold">Custom Chemistry, Precisely Delivered</h1>
        <p class="w-5 mt-3 col-md-6 offset-md-3 text-center">Tailored synthesis of small molecules, from milligram to gram scale — designed to meet your research, development, and quality needs.</p>
        <a class="btn-yellow mt-4" href="#custom-synthesis">Request A Quote</a>
    </div>
</section>

<!-- What We Offer Section -->
<section class="py-5">
    <div class="container">
        <div class="row align-items-center g-5">
            <!-- Image Left, Text Right -->
            <div class="col-md-6">
                <picture>
                    <source srcset="{{ asset('images/web/what-we-offer-3x.webp') }}" media="(min-width: 992px)">
                    <source srcset="{{ asset('images/web/what-we-offer-2x.webp') }}" media="(min-width: 768px)">
                    <img src="{{ asset('images/web/what-we-offer-2x.webp') }}" alt="Custom Molecules. Designed for Discovery." class="img-fluid rounded" loading="lazy">
                </picture>
            </div>
            <div class="col-md-6">
                <h6 class="subtitle">What We Offer</h6>
                <h2 class="section-title">Custom Molecules.<br> Designed for Discovery.</h2>
                <p>Swizchem offers high-quality custom synthesis services for small molecules across pharmaceutical, academic, and industrial sectors. Whether you need reference compounds, intermediates, or complex structures we deliver with</p>
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

<!-- Who We Work With Section -->
<section class="py-5">
    <div class="container">
        <div class="row align-items-center g-5">
            <!-- Text Left, Image Right -->
            <div class="col-md-6">
                <h6 class="subtitle">Who We Work With</h6>
                <h2 class="section-title">Serving Scientists, Researchers, and Innovators</h2>
                <p>Whether you're advancing drug discovery, scaling a lead compound, or exploring a novel scaffold — we’re your synthesis partner.</p>
                <h6 class="subtitle">Our clients include</h6>
                <ul>
                    <li>Academic institutions & postdoctoral researchers</li>
                    <li>Biotech and pharmaceutical R&D labs</li>
                    <li>CROs and startups</li>
                    <li>Chemical sourcing managers</li>
                </ul>
            </div>
            <div class="col-md-6">
                <picture>
                    <source srcset="{{ asset('images/web/who-we-work-3x.webp') }}" media="(min-width: 992px)">
                    <source srcset="{{ asset('images/web/who-we-work-2x.webp') }}" media="(min-width: 768px)">
                    <img src="{{ asset('images/web/who-we-work-2x.webp') }}" alt="Serving Scientists, Researchers, and Innovators" class="img-fluid rounded" loading="lazy">
                </picture>
            </div>
        </div>
    </div>
</section>

<!-- Our Process Section -->
<section class="py-5 sh-custom-bg-light">
    <div class="container">
        <div class="row g-3 text-center">
            <h6 class="subtitle mb-0">Our Process</h6>
            <h2 class="section-title text-center mb-5">How It Works</h2>
        </div>
        <div class="row g-3">
            <div class="col-12 col-sm-6 col-md-3">
                <div class="icon-box">
                    <img src="{{ asset('images/icons/submit-request.svg') }}" class="mb-2" alt="Submit your request" loading="lazy">
                    <p class="fw-bold mb-1">Submit your request</p>
                    <small class="mb-3 d-block">CAS number(if any), upload the structure, share the specs or project details</small>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="icon-box">
                    <img src="{{ asset('images/icons/feasibility-check.svg') }}" class="mb-2" alt="Feasibility check" loading="lazy">
                    <p class="fw-bold mb-1">Feasibility check</p>
                    <small class="mb-3 d-block">We'll evaluate and provide a quote</small>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="icon-box">
                    <img src="{{ asset('images/icons/synthesis.svg') }}" class="mb-2" alt="Synthesis & QC" loading="lazy">
                    <p class="fw-bold mb-1">Synthesis & QC</p>
                    <small class="mb-3 d-block">Handled by our expert chemists</small>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="icon-box">
                    <img src="{{ asset('images/icons/delivery.svg') }}" class="mb-2" alt="Delivery" loading="lazy">
                    <p class="fw-bold mb-1">Delivery</p>
                    <small class="mb-3 d-block">Product shipped with full analytical data</small>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-md-6">
                <picture>
                    <source srcset="{{ asset('images/web/precision-3x.webp') }}" media="(min-width: 992px)">
                    <source srcset="{{ asset('images/web/precision-2x.webp') }}" media="(min-width: 768px)">
                    <img src="{{ asset('images/web/precision-2x.webp') }}" alt="Precision You Can Trust" class="img-fluid rounded" loading="lazy">
                </picture>
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
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="form-wrap">
                    
                    <form id="custom-synthesis" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="step step-1">
                            <div class="row g-3 text-center mb-3">
                                <h6 class="subtitle mb-0">Get In Touch</h6>
                                <h2 class="section-title text-center">Ready to Synthesize Your Next Compound?</h2>
                                <p class="text-center">Form with below details - Upload your structure, share your specs, and our chemists will follow up with a quote and lead time.</p>
                            </div>
                            <p class="col-12 mb-4 text-center fw-bold"><span class="text-danger">*</span>Do not forget to sign-up or Log-in before filling in the details for Custom proposal.</p>
                            <div class="row form-section">
                                <div class="col-md-6 mb-4">
                                    <label for="molecule-name">Company</label>
                                    <input type="text" name="company" class="form-control" placeholder="Enter your Company's name">
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="usage" class="form-label">Usage *</label>
                                    <select name="usage" id="usage" class="form-select" required>
                                        <option value="">Select Usage</option>
                                        <option value="university_lab_research">University / Lab Research</option>
                                        <option value="testing_standards">Testing & Standards</option>
                                        <option value="product_development">Product Development</option>
                                        <option value="regulatory_use">Regulatory Use</option>
                                        <option value="resale_distribution">Resale / Distribution</option>
                                        <option value="other">Other (please specify)</option>
                                    </select>
                                </div>
                                <div class="col-md-12 mb-4" id="usage-other-field" style="display: none;">
                                    <label for="usage_other" class="form-label">Please specify other usage *</label>
                                    <input type="text" name="usage_other" id="usage_other" class="form-control" placeholder="Please specify your usage">
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="molecule-name">Molecule name *</label>
                                    <input type="text" name="molecule_name" class="form-control" placeholder="Molecule name" required>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="purity">Purity *</label>
                                    <input type="text" name="purity" class="form-control" placeholder="e.g., >95%" required>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="molecular_formula">Molecular formula *</label>
                                    <input type="text" name="molecular_formula" class="form-control" placeholder="e.g., 250.3 g/mol" required>
                                </div>
                                <div class="col-md-3 mb-4">
                                    <label for="unit">Unit *</label>
                                    <select name="unit" class="form-select" required>
                                        <option value="">Select Unit</option>
                                        <option value="mg">mg</option>
                                        <option value="gm">g</option>
                                        <option value="kg">kg</option>
                                    </select>
                                </div>
                                <div class="col-md-3 mb-4">
                                    <label for="quantity">Quantity *</label>
                                     <input type="number" name="quantity" class="form-control" placeholder="Enter the quantity" required>
                                </div>
                                <div class="col-md-12 mb-4">
                                    <label for="address">Address</label>
                                     <input type="text" name="address" class="form-control" placeholder="Enter delivery address if different from your registered address" required>
                                </div>
                                <div class="mb-4">
                                    <label for="special-instructions">Special Instructions</label>
                                    <textarea name="special_instructions" class="form-control" placeholder="Lead time, synthesis model and any other details" rows="3"></textarea>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label d-block">Do you want to provide a structure image? *</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="structure_required" id="structureYes" value="yes" checked>
                                        <label class="form-check-label" for="structureYes">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="structure_required" id="structureNo" value="no">
                                        <label class="form-check-label" for="structureNo">No</label>
                                    </div>
                                </div>
                                <div id="structureFields">
                                    <div class="mb-3">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="upload_method" id="uploadImage" value="upload" checked>
                                            <label class="form-check-label" for="uploadImage">Upload an image</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="upload_method" id="drawStructure" value="draw">
                                            <label class="form-check-label" for="drawStructure">Draw the structure</label>
                                        </div>
                                    </div>
                                    <div class="mb-3 image-upload" id="imageUploadArea">
                                        <input type="file" name="structure_file" id="structureFile" accept="image/*" hidden>
                                        <div id="uploadPlaceholder">
                                            <img src="{{ asset('images/icons/image-placeholder.png') }}" alt="upload icon" loading="lazy"/>
                                            <small class="text-muted d-block mt-2">PNG, JPG, GIF up to 2MB</small>
                                        </div>
                                        <div id="imagePreview" style="display: none;">
                                            <img id="previewImage" class="uploaded-image" alt="Structure Preview">
                                            <button type="button" class="remove-image" id="removeImage"><i class="fa fa-close"></i></button>
                                        </div>
                                    </div>
                                    <div class="canvas-container" id="canvasContainer">
                                        <canvas id="sketcher" style="border:1px solid #E1E1E1;" class="w-100"></canvas>
                                        <input type="hidden" name="canvas_data" id="canvasData">
                                    </div>
                                </div>
                                <div class="col-md-12 mb-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="terms_accepted" id="termsAccepted" required>
                                        <label class="form-check-label" for="termsAccepted">
                                            I confirm these products are for research and/or internal use only and agree to the 
                                            <a href="#" id="termsLink" data-bs-toggle="modal" data-bs-target="#termsModal">Terms & Conditions</a>.
                                        </label>
                                    </div>
                                </div>
                                <div class="mt-4 d-flex justify-content-between align-items-center flex-wrap gap-3">
                                    <div>
                                        {!! NoCaptcha::display(['data-callback' => 'enableCustomSynthesisSubmit']) !!}
                                        @error('g-recaptcha-response')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn-yellow" id="enable_custom_synthesis_submit_btn" disabled>
                                        Submit Request
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <!-- Terms & Conditions Modal -->
                    <div class="modal fade" id="termsModal" tabindex="-1">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Terms & Conditions</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="terms-content">
                                        <p><strong>By proceeding, you acknowledge that all products supplied by Swizchem are intended solely for research and internal purposes.</strong></p>
                                        
                                        <p>Your organization accepts full responsibility for:</p>
                                        <ul>
                                            <li>Safe handling of the products</li>
                                            <li>Proper storage of the products</li>
                                            <li>Safe transport of the products</li>
                                            <li>Proper disposal of the products</li>
                                        </ul>
                                        
                                        <p>All activities must be in compliance with all applicable safety and regulatory requirements.</p>
                                        
                                        <p><strong>Swizchem disclaims any liability for misuse or unauthorized application of its products.</strong></p>
                                        
                                        <p>By accepting these terms, you confirm that you understand and agree to these conditions.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <x-alert-success class="shadow-lg rounded-lg p-2" />
                    <x-alert-error class="shadow-lg rounded-lg p-2" />
                </div>
            </div>    
        </div>
    </div>
</section>

@endsection