@push('styles')
<style>
    #checkout-form input.form-control {
        padding-left: 10px!important;
    }
</style>
@endpush

<form id="checkout-form" wire:submit.prevent="submit">
    <div class="mx-5 vh-100">
        <h3 class="mb-4 fw-normal">Your Details</h3>

        <div class="row mb-5">
            <div class="col-md-6">
                <label for="name" class="form-label">Your Name</label>
                <input type="text" class="form-control" id="name" placeholder="James Hoffman" wire:model.live="name">
                @error('name')
                    <span class="text-xs text-danger">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="col-md-6">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" class="form-control" id="email" placeholder="james@gmail.com" wire:model.live="email">
                @error('email')
                    <span class="text-xs text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <hr>
        <div class="mb-3 mt-4">
            <label for="streetAddress" class="form-label">Street Address</label>
            <input type="text" class="form-control" id="streetAddress" placeholder="1 Sesame Street, Big Bird Building" wire:model.live="address">
            @error('address')
                <span class="text-xs text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="unitNumber" class="form-label w-100">Unit / House Number <span class="float-end me-2 fw-normal text-muted">optional</span></label>
                <div class="input-group">
                    <input type="text" class="form-control" id="unitNumber" placeholder="#12-34" wire:model="addressNumber">
                </div>
            </div>
            <div class="col-md-6">
                <label for="postalCode" class="form-label">Postal Code</label>
                <input type="text" class="form-control" id="postalCode" placeholder="123456" wire:model.live="postalCode">
                @error('postalCode')
                    <span class="text-xs text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
    <div class="position-sticky bottom-0 bg-white border-top shadow-none py-3 px-4">
        <div class="d-flex justify-content-between align-items-center">
            <a wire:navigate href="{{ route('cart', $currentSession) }}" class="btn btn-outline-secondary">
                <i class="fa fa-chevron-left me-2"></i> Back
            </a>
            <div class="d-flex align-items-center">
                <strong class="fs-5 fw-normal me-3 mb-3">${{ number_format($order->items->sum('price'), 0, ".", "") }}</strong>
                <button type="submit" class="btn btn-rolo-{{ $validForm ? 'dark' : 'light' }} text-white" @if(!$validForm) disabled @endif>
                    Make Payment <i class="fa fa-chevron-right ms-2"></i>
                </button>
            </div>
        </div>
    </div>
</form>
