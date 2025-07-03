@extends('layouts.main.mainLayout')

@section('title', 'Single Product | Research Chemical | Swizchem')

@section('vite')
    @vite(['resources/js/pages/single-product.js', 'resources/css/pages/single-product.css'])
@endsection

@section('content')

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
            <div class="col-md-6 product-info">
                <h2 class="section-title">Candesartan Methylester</h2>
                <p><strong>Cas:</strong> 13481-44-0</p>
                <p><strong>Catalogue Number:</strong> AISO0031I</p>
                <p><strong>Purity:</strong> &gt;95%</p>
                <p><strong>Molecular Formula:</strong> C25H21N3O3</p>
                <p><strong>Molecular Weight:</strong> 411.453</p>
                <p><strong>Synonym:</strong> 1H-Benzimidazole-7-carboxylicacid,1-[(2′cyano[1,1′-biphenyl]-4-yl)methyl]-2-ethoxy-Methyl ester</p>

                <div class="select-wrap">
                    <select class="form-select w-75">
                        <option>Choose quantity</option>
                        <option>1</option>
                        <option>5</option>
                        <option>10</option>
                    </select>
                    <select class="form-select w-25">
                        <option>MG</option>
                        <option>G</option>
                    </select>
                </div>
                <button class="btn btn-request btn-yellow" href="cart.html">Request For Quote</button>
            </div>
        </div>
    </div>
</section>
@endsection