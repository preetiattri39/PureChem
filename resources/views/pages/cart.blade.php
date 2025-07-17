@extends('layouts.main.mainLayout')

@section('title', 'Your Cart | Swizchem')
@section('robots', 'noindex, nofollow')

@section('vite')
    @vite(['resources/css/pages/cart.css'])
@endsection

@section('content')

<!-- Hero Section -->
<section class="inner-hero sh-custom-bg-light align-items-center">
    <div class="container">
        <h1 class="display-6 fw-bold">Cart</h1>
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
                        <li><a href="{{ route('products.main') }}">All Products</a></li>
                        @foreach($allCategories as $category)
                        <li><a href="{{ route('products.category',['id' => $category['id']]) }}">{{ $category['name'] ?? 'N\A' }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <!-- Product List -->
            <div class="col-md-9">
                @if(!empty($cartItems))
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3 class="fw-bold sh-custom-text-accent">RFQ Items</h3>
                </div>
                <div class="row g-3">
                    <div class="table-wrap">
                        <table class="table rfq-table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>CAS</th>
                                    <th>Quantity</th>
                                    <th>Price (USD)</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="product-title">Candesartan Methylester</td>
                                    <td>13481-44-0</td>
                                    <td>10MG</td>
                                    <td>RFQ</td>
                                    <td><button class="btn btn-sm btn-primary mt-0">Delete</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- Show More -->
                    <div class="d-flex flex-row gap-3 sh-custom-mt-xxl">
                        <button class="btn btn-outline-yellow">Add More Producrs</button>
                        <button class="btn-yellow">Next</button>
                    </div>
                </div>
                @else
                <div class="d-flex flex-column align-items-center gap-3">
                    <h3 class="fw-bold sh-custom-text-accent">Your cart is empty</h3>
                    <div class="fw-normal">Looks like you have not added anything to your cart. Go ahead and explore top categories.</div>
                    <a href="{{ route('products.main') }}" class="btn-yellow">Continue Shopping</a>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection