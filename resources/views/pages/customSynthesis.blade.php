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
                        <img src="{{ asset($section['image']['1x']) }}" alt="{!! $section['title'] !!}" class="img-fluid rounded" loading="lazy">
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
                        <img src="{{ asset($section['image']['1x']) }}" alt="{!! $section['title'] !!}" class="img-fluid rounded" loading="lazy">
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
                        <img src="{{ asset($step['icon']) }}" class="mb-2" alt="{{ $step['title'] }}" loading="lazy">
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
                    <img src="{{ asset($quality['image']['1x']) }}" alt="{!! $quality['title'] !!}" class="img-fluid rounded" loading="lazy">
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
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="form-wrap">
                    <!-- Alert Messages -->
                    <div id="alert-message" style="display: none;"></div>
                    
                    <form id="custom-synthesis" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="step step-1">
                            <div class="row g-3 text-center mb-3">
                                <h6 class="subtitle mb-0">Get In Touch</h6>
                                <h2 class="section-title">Ready to Synthesize Your Next Compound?</h2>
                                <p class="text-center">Form with below details - Upload your structure, share your specs, and our chemists will follow up with a quote and lead time.</p>
                            </div>
                            <div class="row form-section">
                                <div class="col-md-6 mb-4">
                                    <label for="molecule-name">Name *</label>
                                    <input type="text" name="name" class="form-control" placeholder="Enter your name" required>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="molecule-name">Email *</label>
                                    <input type="text" name="email" class="form-control" placeholder="Enter your E-mail" required>
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
                                    <label for="molecular-weight">Molecular weight *</label>
                                    <input type="text" name="molecular_weight" class="form-control" placeholder="e.g., 250.3 g/mol" required>
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
                                    <select name="quantity" class="form-select" required>
                                        <option value="">Select Quantity</option>
                                        <option value="5">5</option>
                                        <option value="10">10</option>
                                        <option value="20">20</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                        <option value="200">200</option>
                                        <option value="250">250</option>
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <label for="special-instructions">Special Instructions</label>
                                    <textarea name="special_instructions" class="form-control" placeholder="Lead time, synthesis model and any other details" rows="3"></textarea>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label d-block">Structure Image Requirement? *</label>
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
                                            <button type="button" class="remove-image" id="removeImage">&times;</button>
                                        </div>
                                    </div>
                                    <div class="canvas-container" id="canvasContainer">
                                        <canvas id="sketcher" style="border:1px solid #E1E1E1;" class="w-100"></canvas>
                                        <input type="hidden" name="canvas_data" id="canvasData">
                                    </div>
                                </div>
                                <div class="mt-4 d-flex justify-content-end">
                                    <button type="submit" class="btn-yellow" id="submitBtn">
                                        <span class="spinner-border spinner-border-sm me-2" style="display: none;" id="submitSpinner"></span>
                                        Submit Request
                                    </button>
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