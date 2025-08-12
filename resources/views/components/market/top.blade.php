<div class="row align-items-center g-3 mb-4">
    <div class="col-12 col-md-3">
        <a href="{{ route('catalogue') }}">
            <img class="img-fluid" src="/assets/img/logos/rolo.png" />
        </a>
    </div>
    <div class="col-12 col-md-6">
        <x-market.search :searchQuery="$searchQuery" />
    </div>
    <div class="col-12 col-md-3 d-flex justify-content-md-end gap-3">
        <div class="btn btn-outline-secondary mb-0">Filters</div>
        @if($cartCount > 0)
            <a href="{{ route('cart', session('current_session')) }}" class="btn btn-rolo-dark text-white border mb-0">
                Your Cart
                <span>({{ $cartCount }})</span>
            </a>
        @else
            <div class="btn btn-rolo-light text-white border mb-0">Your Cart</div>
        @endif
    </div>
</div>