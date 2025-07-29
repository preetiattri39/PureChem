@extends('layouts.main.mainLayout')

@section('title', 'Checkout | Swizchem')
@section('robots', 'noindex, nofollow')

@section('vite')
    @vite([])
@endsection

@section('content')

<!-- Hero Section -->
<section class="inner-hero sh-custom-bg-light align-items-center">
    <div class="container">
        <h1 class="display-5 fw-bold">Checkout</h1>
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
                <div class="mb-3">
                    <h3 class="fw-bold sh-custom-text-accent">RFQ Form</h3>
                    <p>To continue please fill out the following form.</p>
                </div>
                <div class="row g-4">
                    <div class="col-md-12">
                        <div class="form-wrap">
                            <div class="form-section">
                                <div class="section-title">Billing address details</div>
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form method="POST" action="{{ route('checkout.submit') }}">
                                    @csrf

                                    <div class="mb-4">
                                        <label>Name</label>
                                        <input type="text" name="name" class="form-control form-control @error('name') is-invalid @enderror" placeholder="Name" value="{{ old('name') }}">
                                    </div>

                                    <div class="mb-4">
                                        <label>Email</label>
                                        <input type="email" name="email" class="form-control form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{ old('email') }}">
                                    </div>

                                    <div class="mb-4">
                                        <label>Phone Number</label>
                                        <input type="text" name="phone" class="form-control form-control @error('phone') is-invalid @enderror" placeholder="Phone number" value="{{ old('phone') }}">
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <label for="autocomplete">Address</label>
                                            <input type="text" id="autocomplete" name="address" class="form-control @error('address') is-invalid @enderror" placeholder="Enter your full address..." value="{{ old('address') }}">
                                        </div>

                                        <div class="col-md-6 mb-4">
                                            <label for="country">Country</label>
                                            <select id="country" name="country" class="form-select form-control @error('country') is-invalid @enderror">
                                                <option value="" selected disabled>Select Country</option>
                                                @foreach (get_all_countries() as $country)
                                                    <option value="{{ $country }}" {{ old('country') == $country ? 'selected' : '' }}>{{ $country }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-6 mb-4">
                                            <label>City</label>
                                            <input type="text" name="city" class="form-control form-control @error('city') is-invalid @enderror" placeholder="City name" value="{{ old('city') }}">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-4">
                                            <label for="province">Province</label>
                                            <input type="text" id="province" name="province" class="form-control @error('province') is-invalid @enderror" placeholder="Province" value="{{ old('province') }}">
                                        </div>

                                        <div class="col-md-6 mb-4">
                                            <label>Postal Code</label>
                                            <input type="text" name="postal_code" class="form-control @error('postal_code') is-invalid @enderror" placeholder="Postal Code" value="{{ old('postal_code') }}">
                                        </div>
                                    </div>

                                    <button type="submit" onclick="$('#sh-loader').removeClass('d-none')" class="btn-yellow">Submit</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection