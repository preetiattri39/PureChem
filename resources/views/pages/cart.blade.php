@extends('layouts.main.mainLayout')

@section('title', 'Your Cart | Swizchem')
@section('robots', 'noindex, nofollow')

@section('vite')
    @vite(['resources/css/pages/cart.css','resources/js/pages/cart.js'])
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
            <div class="col-md-3 d-none d-md-block">
                <div class="sidebar">
                    <h5>Category</h5>
                    <ul class="d-flex flex-column gap-3 list-unstyled">
                        <li class="text-start"><a href="{{ route('products.main') }}">All Products</a></li>
                        @foreach($allCategories as $category)
                        <li class="text-start"><a href="{{ route('products.category',['id' => $category['id']]) }}">{{ $category['name'] ?? 'N\A' }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <!-- Product List -->
            <div class="cart-product-listing col-md-9">
                @if(!empty($cartItems))
                <div class="mb-3">
                    <h3 class="fw-bold sh-custom-text-accent">RFQ Items</h3>
                    <div class="cart-head-info">Looking for a different purity, quantity, or specification of a product already in your cart? You can request a tailored option through our <a href="{{ route('custom-synthesis') }}" target="_self" >Custom Synthesis</a> page.</div>
                </div>
                <div class="row g-3">
                    <div class="table-wrap overflow-auto overflow-md-visible">
                        <table class="table rfq-table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>CAS</th>
                                    <th>Quantity</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ( $cartItems as $item )
                                    <tr>
                                        <td class="product-title">{{ $item['product_name'] }}</td>
                                        <td>{{ $item['cas_number'] }}</td>
                                        <td>{{ $item['quantity'] ? $item['quantity'] : 'N/A' }}</td>
                                        <td><button class="delete-cart-item btn btn-sm btn-primary mt-0" data-id="{{ $item['id'] }}">Delete</button></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <x-alert-success class="shadow-lg rounded-lg p-2" />
                    <x-alert-error class="shadow-lg rounded-lg p-2" />
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                {{ $errors->first() }}
                            </ul>
                        </div>
                    @endif
                    <!-- Show More -->
                    <div class="d-flex flex-row gap-3 sh-custom-mt-xxl">
                        <a href="{{ route('products.main') }}" class="btn btn-outline-yellow">Add More Products</a>
                        <a href="{{ route('checkout') }}" class="btn-yellow">Submit</a>
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