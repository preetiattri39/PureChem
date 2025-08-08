@extends('layouts.main.mainLayout')

@section('title', 'Single Product | Research Chemical | Swizchem')

@section('vite')
    @vite(['resources/css/pages/single-product.css','resources/js/pages/single-product.js'])
@endsection

@section('content')
<script>
    window.productVariants = @json($variantsGrouped);
    // console.log(window.productVariants)
</script>
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
                    <img 
                        src="{{ $product['structure'] ? asset('storage/' . $product['structure']) : asset('images/placeholder-image.webp') }}" 
                        alt="Compound molecular structure" 
                        loading="lazy" />
                </div>
            </div>
            <div class="col-md-6 product-info sh-break-all">
                <h2 class="section-title">{{ $product['name'] }}</h2>
                <p><strong>Product Code :</strong> {{ $product['product_code'] ?? 'N/A' }}</p>
                <p><strong>Cas :</strong> {{ $product['cas_number'] ?? 'N/A' }}</p>
                <p><strong>Purity :</strong> {{ $product['purity'] ?? 'N/A' }}</p>
                <p><strong>Molecular Formula :</strong> {{ $product['molecular_formula'] ?? 'N/A' }}</p>
                <p><strong>Molecular Weight :</strong> {{ $product['molecular_weight'] ?? 'N/A' }}</p>
                <p><strong>Synonym :</strong> {{ $product['synonym'] ?? 'N/A' }}</p>
                <p><strong>Storage :</strong> {{ $product['storage'] ?? 'N/A' }}</p>
                <p><strong>Aspect :</strong> {{ $product['aspect'] ?? 'N/A' }}</p>
                <p><strong>Uses :</strong> {{ $product['uses'] ?? 'N/A' }}</p>


                <div id="unit-quantity-selector" class="select-wrap">
                    <select id="unitSelect" class="form-select w-25"></select>
                    <select id="quantitySelect" class="form-select w-75"></select>
                </div>
                <form id="addToCartForm">
                    @csrf
                    <input  id="productInput" type="hidden" name="product_id" value="{{ $product['id'] }}">
                    <input id="variantInput" type="hidden" name="product_variant" value="">
                    <x-alert-success class="shadow-lg rounded-lg my-4 p-2" />
                    <x-alert-error class="shadow-lg rounded-lg my-4 p-2" />
                    <button type="submit" class="btn-request btn-yellow">Add to cart</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection