<div class="col-12 col-md-6 col-xl-4">
    <div class="product-card">
        <a href="{{ route('products.single') }}">
            <div class="product-image">
                <img src="{{ asset('images/compounds/image 10.png') }}" alt="Chemical">
            </div>
        </a>
        <div class="product-content">
            <a href="{{ route('products.single') }}">
                <h6>{{ $product['name'] ?? 'N\A' }}</h6>
            </a>
            <p class="mb-1"><strong>Cas:</strong> {{ $product['cas_number'] ?? 'N\A' }}</p>
            <p class="mb-1"><strong>Formula:</strong> {{ $product['molecular_formula'] ?? 'N\A' }}</p>
            <p class="mb-3"><strong>MW:</strong> 411.453</p>
            <button href="{{ route('cart') }}" class="btn-yellow mx-auto d-block">Request For Quote</button>
        </div>
    </div>
</div>
