<?php

namespace App\Observers;

use Illuminate\Support\Str;
use App\Models\Product;

class ProductObserver
{
    /**
     * Handle the Profile "creating" event.
     */
    public function creating(Product $item): void
    {
        $item->slug = Str::slug($item->name);
    }

}
