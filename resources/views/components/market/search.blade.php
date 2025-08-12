<form x-data @submit.prevent="$wire.performSearch()" wire:submit="performSearch">
    <div class="input-group shadow-none rounded-3 search-group">
        <span class="input-group-text border-0 bg-transparent">
            <i class="fa fa-search text-secondary"></i>
        </span>
        <input wire:model.live="searchQuery" type="search" class="form-control p-2 ps-4" placeholder="Search" aria-label="Search" required />
    </div>
</form>