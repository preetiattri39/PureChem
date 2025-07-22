<div class="col-12 col-md-6 col-xl-4">
    <div class="product-card">
        <div class="product-image">
            <img src="{{ asset('images/compounds/image 10.png') }}" alt="Chemical" loading="lazy">
        </div>
        <div class="product-content">
            <h6>{{ $product['name'] ?? 'N\A' }}</h6>
            <p class="mb-1"><strong>Cas:</strong> {{ $product['cas_number'] ?? 'N\A' }}</p>
            <p class="mb-1"><strong>Formula:</strong> {{ $product['molecular_formula'] ?? 'N\A' }}</p>
            <p class="mb-3"><strong>MW:</strong> 411.453</p>
            <a href="{{ route('products.single',['id' => $product['id']]) }}" class="btn-yellow mx-auto d-block">Show More Details</a>
        </div>
    </div>
</div>
