<div>
    <x-market.top :cartCount="$cartCount ?? 0" :searchQuery="$searchQuery ?? ''" />

    <h4 class="h3 fw-normal mb-4" title={{ $currentSession }}>{{ $title }}</h4>

    <div class="row g-4">
        @foreach ($items as $product)
            <div wire:key="product-{{ $loop->iteration }}" class="col-12 col-sm-6 col-lg-3">
                <a wire:navigate href="{{ route('product', $product->slug) }}" class="card cursor-pointer h-100 border-0 product-card shadow-none">
                    <div class="card-header bg-white border product-card-header p-3">
                        <img src="{{ asset('assets/img/'.$product->image_urls[0]) ?? '' }}" class="img-fluid product-card-image" alt="product-{{ $loop->iteration }}" />
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h5 class="card-title mb-0 text-dark">the {{ $product->name }}</h5>
                            <span class="text-dark fw-bold">${{ number_format($product->price) }}</span>
                        </div>
                        <p class="card-text text-secondary small mb-0">{{ $product->short_desc }}</p>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>