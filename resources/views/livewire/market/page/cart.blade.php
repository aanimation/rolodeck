<div class="mx-5">
    <div class="row mb-4 align-items-center">
        <div class="col-12 col-md-6">
            <h3 class="fw-normal mb-0">Your Cart</h3>
        </div>
        <div class="col-12 col-md-6 text-md-end">
            <span class="text-muted">{{ $order->items->sum('unit') }} items</span>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <ul class="list-group list-group-flush">
                @foreach($order->items as $item)
                <li class="list-group-item d-flex align-items-center p-3">
                    <img src="{{ asset('/assets/img/'.$item->product->image_urls[0]) }}" alt="Barista Express" class="rounded me-3" style="width: 80px; height: 80px; object-fit: cover;">
                    <div class="flex-grow-1">
                        <h5 class="mb-1">the {{ $item->product->name }}</h5>
                        @if($item->color)
                            <p class="mb-0 text-muted">{{ $item->color }}</p>
                        @endif
                    </div>
                    <div class="text-end me-3">
                        <p class="mb-0 fw-bold">${{ number_format($item->product->promo_price ?? $item->product->price, 0, ".", "") }}</p>
                        <p class="mb-0 text-muted small">{{ $item->unit }} unit</p>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="position-sticky bottom-0 bg-white border-top shadow-none py-3 px-4">
        <div class="d-flex justify-content-between align-items-center">
            <a wire:navigate href="{{ route('catalogue') }}" class="btn btn-outline-secondary">
                <i class="fa fa-chevron-left me-2"></i> Back
            </a>
            <div class="d-flex align-items-center">
                <strong class="fs-5 fw-normal me-3 mb-3">Total ${{ number_format($order->items->sum('price'), 0, ".", "") }}</strong>
                <div wire:click="doCheckout" wire:loading.attr="disabled" class="btn btn-rolo-dark text-white">
                    <span wire:loading.remove>Checkout <i class="fa fa-chevron-right ms-2"></i></span>
                    <span wire:loading.delay.longest>Preparing...</span>
                </div>
            </div>
        </div>
    </div>
</div>