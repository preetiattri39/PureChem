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
                        @foreach($allCategories as $category)
                        <li><a href="#">{{ $category['name'] ?? 'N\A' }}</a></li>
                        @endforeach
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
                    @foreach($products as $product)
                    <div class="col-md-4">
                        <div class="product-card">
                            <a href="{{ route('products.single') }}">
                                <div class="product-image">
                                    <img src="{{ asset('images/compounds/image 10.png') }}"" alt="Chemical">
                                </div>
                            </a>
                            <div class="product-content">
                                <a href="{{ route('products.single') }}">
                                    <h6>{{ $product['name'] ?? 'N\A' }}</h6>
                                </a>
                                <p class="mb-1"><strong>Cas:</strong> {{ $product['cas_number'] ?? 'N\A' }}</p>
                                <p class="mb-1"><strong>Formula:</strong> {{ $product['molecular_formula'] ?? 'N\A' }}</p>
                                <p class="mb-3"><strong>MW:</strong> 411.453</p>
                                <button href="{{route('cart')}}" class="btn-yellow mx-auto d-block">Request For Quote</button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    
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