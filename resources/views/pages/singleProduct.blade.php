@extends('layouts.main.mainLayout')

@section('title', 'Single Product | Research Chemical | Swizchem')

@section('vite')
    @vite(['resources/css/pages/single-product.css'])
@endsection

@section('content')
@php 
echo "<pre>";
    print_r($variantsGrouped);
 @endphp
<section>
    <div class="container mt-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('products.main') }}">All Products</a></li>
                <li class="breadcrumb-item active" aria-current="page">Product Details</li>
            </ol>
        </nav>
    </div>
</section>
<!-- Breadcrumb -->
<section class="py-5">
    <div class="container mt-4">
    <!-- Product Content -->
        <div class="row align-items-start g-5">
            <div class="col-md-6">
                <div class="featured-image">
                    <img src="{{ asset('images/compounds/product-image.jpg') }}" alt="Product Structure" class="image">
                </div>
            </div>
            <div class="col-md-6 product-info sh-break-all">
                <h2 class="section-title">{{ $product['name'] }}</h2>
                <p><strong>Cas:</strong>{{ $product['cas_number'] }}</p>
                <p><strong>Purity:</strong> {{ $product['purity'] }}</p>
                <p><strong>Molecular Formula:</strong> {{ $product['molecular_formula'] }}</p>
                <p><strong>Molecular Weight:</strong> {{ $product['molecular_weight'] }}</p>
                <p><strong>Synonym:</strong> {{ $product['synonym'] }}</p>

                <div class="select-wrap">
                    <select class="form-select w-25">
                        <option>MG</option>
                        <option>G</option>
                    </select>
                    <select class="form-select w-75">
                        <option>Choose quantity</option>
                    </select>
                </div>
                <button class="btn-request btn-yellow" href="cart.html">Request For Quote</button>
            </div>
        </div>
    </div>
</section>
@endsection