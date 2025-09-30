<div class="col-12 col-md-6 col-xl-4">
    <div class="product-card">
        <div class="product-info">
            <div class="product-image">
                <img 
                    src="{{ $product['structure'] ? asset('storage/' . $product['structure']) : asset('images/placeholder-image.webp') }}" 
                    alt="Compound molecular structure" 
                    loading="lazy" />
            </div>
            <div class="product-content">
                <h6 class="sh-break-all">{{ $product['name'] ?? 'N\A' }}</h6>
                <p class="mb-1"><strong>CAS:</strong> {{ $product['cas_number'] ?? 'N\A' }}</p>
                <p class="mb-1"><strong>Formula:</strong> {{ $product['molecular_formula'] ?? 'N\A' }}</p>
                <p class="mb-3"><strong>MW:</strong>{{ $product['molecular_weight'] ?? 'N\A' }}</p>
            </div>
        </div>
        <a href="{{ route('products.single',['id' => $product['id']]) }}" class="product-card-single btn-yellow mx-auto">Show More Details</a>
    </div>
</div>
