@extends('layouts.main.mainLayout')

@section('title', 'Chemical Catalog | Research Chemicals, Natural Products & Oligopeptides')
@section('meta_description', 'Explore Swizchem’s complete catalog of high-purity research chemicals including natural products, APIs, peptides, ligands, and more.')
@section('meta_keywords', 'Swizchem chemical catalog, research chemicals, natural products, peptides, oligopeptides, reagents, amino acids, APIs, isotopic compounds')

{{-- Open Graph for Facebook/LinkedIn --}}
@section('og_title', View::getSection('title'))
@section('og_description', View::getSection('meta_description'))

{{-- Twitter Card --}}
@section('twitter_title', View::getSection('title'))
@section('twitter_description', View::getSection('meta_description'))


@section('vite')
    @vite(['resources/js/pages/products.js', 'resources/css/pages/products.css'])
@endsection

@section('content')

<!-- Hero Section -->
<section class="inner-hero sh-custom-bg-light align-items-center">
    <div class="container">
        <div class="row">
            <x-chemical-search
                title="Chemical Catalog - Complete Products List"
                placeholder="Search by chemical name or CAS"
                :action="route('products.main')"
                method="GET"
                button-text="Search"
                form-value="{{ $_GET['search'] ?? '' }}"
            />
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
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="m-0">Category</h5>
                        <button class="btn btn-link d-md-none p-0 text-decoration-none" type="button" id="categoryToggle">
                            <span id="toggleIcon">+</span>
                        </button>
                    </div>
                    <ul class="d-none d-md-flex flex-column gap-3 list-unstyled" id="categoryList">
                        <li class="text-start {{ !Request::route('id') ? 'sidebar-active-category' : '' }}">
                            <a href="{{ route('products.main') }}">All Products</a>
                        </li>
                        @foreach($allCategories as $category)
                        <li class="text-start {{ Request::route('id') == $category['id'] ? 'sidebar-active-category' : '' }}">
                            <a href="{{ route('products.category',['id' => $category['id']]) }}">{{ $category['name'] ?? 'N\A' }}</a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <!-- Product List -->
            <div class="col-md-9">
                @if(count($products))
                <div class="d-flex flex-row justify-content-center justify-content-sm-between align-items-center mb-3 flex-wrap">
                    <h2 class="section-title">All Products</h2>
                    <select id="sort-select" class="form-select sort-by w-auto">
                        <option selected disabled>Sort By</option>
                        <option value="name_asc">Name A-Z</option>
                        <option value="name_desc">Name Z-A</option>
                        <option value="date_asc">Date ASC</option>
                        <option value="date_desc">Date DESC</option>
                        <option value="availability">Availability</option>
                    </select>
                </div>
                <div id="product-container" data-page="2" data-category="{{ request()->route('id') ?? '' }}" data-search="{{ request('search') ?? '' }}" data-sort="" class="row g-3">
                    @include('partials.product-cards', ['products' => $products])
                </div>
                
                @if($hasMore)
                    <div class="text-center mt-4">
                        <button id="load-more" class="btn btn-outline-primary">Show More Products</button>
                    </div>
                @endif
                
                @else
                    <div class="text-center py-3 no-products" > No products found!</div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection