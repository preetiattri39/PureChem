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

@section('content')

<!-- Hero Section -->
<section class="inner-hero sh-custom-bg-light align-items-center">
    <div class="container text-center">
        <h1 class="display-6 fw-bold">{{ $hero['title'] }}</h1>
        <p class="w-5 mt-3 col-md-6 offset-md-3 text-center">{{ $hero['description'] }}</p>
        <button class="btn-yellow mt-4">{{ $hero['buttonText'] }}</button>
    </div>
</section>

<!-- Content Sections -->
@foreach ($sections as $index => $section)
<section class="py-5">
    <div class="container">
        <div class="row align-items-center g-5">
            @if ($index % 2 === 0)
                <!-- Image Left, Text Right -->
                <div class="col-md-6">
                    <picture>
                        <source srcset="{{ asset($section['image']['3x']) }}" media="(min-width: 992px)">
                        <source srcset="{{ asset($section['image']['2x']) }}" media="(min-width: 768px)">
                        <img src="{{ asset($section['image']['1x']) }}" alt="{!! $section['title'] !!}" class="img-fluid rounded">
                    </picture>
                </div>
                <div class="col-md-6">
                    <h6 class="subtitle">{{ $section['subtitle'] }}</h6>
                    <h2 class="section-title">{!! $section['title'] !!}</h2>
                    <p>{{ $section['paragraph'] }}</p>
                    @if (!empty($section['sublistTitle']))
                        <h6 class="subtitle">{{ $section['sublistTitle'] }}</h6>
                    @endif
                    <ul>
                        @foreach ($section['list'] as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </ul>
                </div>
            @else
                <!-- Text Left, Image Right -->
                <div class="col-md-6">
                    <h6 class="subtitle">{{ $section['subtitle'] }}</h6>
                    <h2 class="section-title">{!! $section['title'] !!}</h2>
                    <p>{{ $section['paragraph'] }}</p>
                    @if (!empty($section['sublistTitle']))
                        <h6 class="subtitle">{{ $section['sublistTitle'] }}</h6>
                    @endif
                    <ul>
                        @foreach ($section['list'] as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-md-6">
                    <picture>
                        <source srcset="{{ asset($section['image']['3x']) }}" media="(min-width: 992px)">
                        <source srcset="{{ asset($section['image']['2x']) }}" media="(min-width: 768px)">
                        <img src="{{ asset($section['image']['1x']) }}" alt="{!! $section['title'] !!}" class="img-fluid rounded">
                    </picture>
                </div>
            @endif
        </div>
    </div>
</section>
@endforeach
<!-- Our Process Section -->
<section class="py-5 sh-custom-bg-light">
    <div class="container">
        <div class="row g-3 text-center">
            <h6 class="subtitle mb-0">{{ $our_process['subtitle'] }}</h6>
            <h2 class="section-title mb-5">{{ $our_process['title'] }}</h2>
        </div>
        <div class="row g-3">
            @foreach ($our_process['steps'] as $step)
                <div class="col-6 col-md-3">
                    <div class="icon-box">
                        <img src="{{ asset($step['icon']) }}" class="mb-2" alt="{{ $step['title'] }}">
                        <p class="fw-bold mb-1">{{ $step['title'] }}</p>
                        <small class="mb-3 d-block">{{ $step['desc'] }}</small>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<section class="py-5">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-md-6">
                <picture>
                    <source srcset="{{ asset($quality['image']['3x']) }}" media="(min-width: 992px)">
                    <source srcset="{{ asset($quality['image']['2x']) }}" media="(min-width: 768px)">
                    <img src="{{ asset($quality['image']['1x']) }}" alt="{!! $quality['title'] !!}" class="img-fluid rounded">
                </picture>
            </div>
            <div class="col-md-6">
                <h6 class="subtitle mb-0">{{ $quality['subtitle'] }}</h6>
                <h2 class="section-title">{!! $quality['title'] !!}</h2>
                <p>{{ $quality['paragraph'] }}</p>
                <ul>
                    @foreach ($quality['list'] as $item)
                        <li>{{ $item }}</li>
                    @endforeach
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
                                    <div class="canvas-container">
                                        <canvas width="300" height="80" style="border:1px solid #E1E1E1;background: #E1E1E1;border-radius:20px" class="w-100"></canvas>
                                    </div>
                                </div>
                                <div class="mt-4 d-flex justify-content-end">
                                    <button type="button" class="btn-yellow" onclick="nextStep()">Next</button>
                                </div>
                            </div>
                        </div>
                        <!-- Step 2 -->
                        <div class="step step-2">
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
                                <div id="newCustomerFields" class="">
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
                                    <button type="submit" class="btn btn-yellow">Submit Order</button>
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