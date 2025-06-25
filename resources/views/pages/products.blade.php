@extends('layouts.main.mainLayout')
@section('title', 'Welcome')

@section('vite')
    @vite(['resources/js/pages/products.js', 'resources/css/pages/products.css'])
@endsection

@section('content')

<!-- Hero Section -->
<section class="inner-hero sh-custom-bg-light align-items-center">
    <div class="container">
        <div class="row">
            <div class="col-12 d-flex flex-column justify-content-center align-items-center gap-4">
                <h1 class="display-6 fw-bold">Chemical Catalog - Complete Products List</h1>
                <form class="d-flex justify-content-center col-6 position-relative search-form">
                    <input type="text" class="form-control" placeholder="Search by chemical name or CAS" />
                    <button class="btn-yellow form-btn">Search</button>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- Products Section -->
<section class="py-5">
    <!-- Main Content -->
    <div class="container">
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
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3 class="fw-bold sh-custom-text-accent">All Products</h3>
                    <select class="form-select sort-by w-auto">
                        <option selected>Sort By</option>
                        <option>Name</option>
                        <option>Availability</option>
                        <option>Popular products</option>
                        <option>Newly added chemicals</option>
                    </select>
                </div>
                <div class="row g-3">
                    <!-- Product Card Example -->
                    <div class="col-md-4">
                        <div class="product-card">
                            <a href="{{ route('products.single') }}">
                                <div class="product-image">
                                    <img src="{{ asset('images/compounds/image 10.png') }}"" alt="Chemical">
                                </div>
                            </a>
                            <div class="product-content">
                                <a href="{{ route('products.single') }}">
                                    <h6>Candesartan Methylester</h6>
                                </a>
                                <p class="mb-1"><strong>Cas:</strong> 13481-44-0</p>
                                <p class="mb-1"><strong>Formula:</strong> C25H23N3O3</p>
                                <p class="mb-3"><strong>MW:</strong> 411.453</p>
                                <button href="cart.html" class="btn-yellow mx-auto d-block">Request For Quote</button>
                            </div>
                        </div>
                    </div>
                    <!-- Repeat this block for each product -->
                    <div class="col-md-4">
                        <div class="product-card">
                            <a href="{{ route('products.single') }}"> 
                                <div class="product-image">
                                    <img src="{{ asset('images/compounds/image 11.png') }}"" alt="Chemical">
                                </div>
                            </a>
                            <div class="product-content">
                                <a href="{{ route('products.single') }}">
                                    <h6>Candesartan Methylester</h6>
                                </a>
                                <p class="mb-1"><strong>Cas:</strong> 13481-44-0</p>
                                <p class="mb-1"><strong>Formula:</strong> C25H23N3O3</p>
                                <p class="mb-3"><strong>MW:</strong> 411.453</p>
                                <button href="cart.html" class="btn-yellow mx-auto d-block">Request For Quote</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="product-card">
                            <a href="{{ route('products.single') }}">
                                <div class="product-image">
                                    <img src="{{ asset('images/compounds/image 12.png') }}"" alt="Chemical">
                                </div>
                            </a>
                            <div class="product-content">
                                <a href="{{ route('products.single') }}">
                                    <h6>Candesartan Methylester</h6>
                                </a>
                                <p class="mb-1"><strong>Cas:</strong> 13481-44-0</p>
                                <p class="mb-1"><strong>Formula:</strong> C25H23N3O3</p>
                                <p class="mb-3"><strong>MW:</strong> 411.453</p>
                                <button href="cart.html" class="btn-yellow mx-auto d-block">Request For Quote</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="product-card">
                            <a href="{{ route('products.single') }}">
                                <div class="product-image">
                                    <img src="{{ asset('images/compounds/image 13.png') }}"" alt="Chemical">
                                </div>
                            </a>
                            <div class="product-content">
                                <a href="{{ route('products.single') }}">
                                    <h6>Candesartan Methylester</h6>
                                </a>
                                <p class="mb-1"><strong>Cas:</strong> 13481-44-0</p>
                                <p class="mb-1"><strong>Formula:</strong> C25H23N3O3</p>
                                <p class="mb-3"><strong>MW:</strong> 411.453</p>
                                <button href="cart.html" class="btn-yellow mx-auto d-block">Request For Quote</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="product-card">
                            <a href="{{ route('products.single') }}">
                                <div class="product-image">
                                    <img src="{{ asset('images/compounds/image 14.png') }}"" alt="Chemical">
                                </div>
                            </a>
                            <div class="product-content">
                                <a href="{{ route('products.single') }}">
                                    <h6>Candesartan Methylester</h6>
                                </a>
                                <p class="mb-1"><strong>Cas:</strong> 13481-44-0</p>
                                <p class="mb-1"><strong>Formula:</strong> C25H23N3O3</p>
                                <p class="mb-3"><strong>MW:</strong> 411.453</p>
                                <button href="cart.html" class="btn-yellow mx-auto d-block">Request For Quote</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="product-card">
                            <a href="{{ route('products.single') }}">
                                <div class="product-image">
                                    <img src="{{ asset('images/compounds/image 15.png') }}"" alt="Chemical">
                                </div>
                            </a>
                            <div class="product-content">
                                <a href="{{ route('products.single') }}">
                                    <h6>Candesartan Methylester</h6>
                                </a>
                                <p class="mb-1"><strong>Cas:</strong> 13481-44-0</p>
                                <p class="mb-1"><strong>Formula:</strong>     C25H23N3O3</p>
                                <p class="mb-3"><strong>MW:</strong> 411.453</p>
                                <button href="/cart.html" class="btn-yellow mx-auto d-block">Request For Quote</button>
                            </div>
                        </div>
                    </div>
                    <!-- Show More -->
                    <div class="text-center mt-4">
                        <button class="btn btn-outline-primary">Show More Products</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection