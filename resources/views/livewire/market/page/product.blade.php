<div>
    <x-market.top :cartCount="$cartCount ?? 0" :searchQuery="$searchQuery ?? ''" />

    <div class="row vh-100">
        <div class="col-md-6">
            <!-- Main Carousel -->
            <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach($item->image_urls as $imgUrl)
                    <div class="carousel-item{{ $loop->first ? ' active' : '' }}">
                        <img src="{{ asset('assets/img/'.$imgUrl) }}" class="d-block w-100 product-image img-fluid bg-white" alt="Image 2" style="height: 400px; object-fit: contain;">
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Thumbnail Indicators -->
            <div class="mt-3 d-flex justify-content-center">
                <div class="d-flex gap-2">
                    @foreach($item->image_urls as $thumbUrl)
                    <button type="button" data-bs-target="#productCarousel" data-bs-slide-to="{{ $loop->index }}" class="border rounded overflow-hidden bg-white p-0" style="width: 60px; height: 60px;">
                        <img src="{{ asset('assets/img/'.$thumbUrl) }}" class="w-100 h-100" alt="Thumb-{{ $loop->iteration}}">
                    </button>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="col-md-6 d-flex flex-column">
            <div class="px-3 py-4" style="flex: 1;">
                <x-market.breadcrumb />

                <h3 class="mb-2 fw-normal">the {{ $item->name }}</h3>
                <p class="mb-4">{{ $item->short_desc }}</p>

                <div class="d-flex align-items-center mb-4">
                    @if($item->promo_price)
                    <del class="me-3">${{ number_format($item->price, 0) }}</del>
                    @endif
                    <span class="fs-4 fw-bold">${{ number_format($item->promo_price ?? $item->price, 0) }}</span>
                </div>

                <hr class="my-4">

                @if($item->colors)
                <div class="mb-4">
                    <h6>Colour</h6>
                    <div class="d-flex align-items-center">
                        <div class="color-option bg-light selected-color" data-color="stainless-steel" style="width:30px; height:30px; border-radius:50%; border:2px solid #000; margin-right:10px; cursor: pointer;"></div>
                        <div class="color-option bg-dark" data-color="black" style="width:30px; height:30px; border-radius:50%; margin-right:10px; cursor: pointer;"></div>
                        <span class="ms-auto">Stainless Steel</span>
                    </div>
                </div>
                @endif

                <div class="product-description" style="max-height: 350px; overflow-y: auto;">
                    {!! $item->description !!}

                    @if($item->content)
                        <p class="fw-bold mt-3 mb-2">What&quot;s in the box</p>
                        <p class="fw-normal">On top of the machine itself, this comes with:</p>
                        <ul>
                        @foreach($item->content as $content)
                        <li>{!! $content !!}</li>
                        @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>

        <div class="position-sticky bottom-0 bg-white border-top shadow-none py-3 px-4">
            <div class="d-flex justify-content-between align-items-center">
                <a wire:navigate href="{{ route('catalogue') }}" class="btn btn-outline-secondary">
                    <i class="fa fa-chevron-left me-2"></i> Back
                </a>
                <div class="d-flex align-items-center">
                    <strong class="fs-5 fw-normal me-3 mb-3">${{ number_format($item->promo_price ?? $item->price, 0) }}</strong>
                    <div wire:click="addToCart" wire:loading.attr="disabled" class="btn btn-rolo-dark text-white">
                        <span wire:loading.remove>Add to Cart <i class="fa fa-chevron-right ms-2"></i></span>
                        <span wire:loading.delay.longest>Adding...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>