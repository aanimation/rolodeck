<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Observers\ProductObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;

#[ObservedBy([ProductObserver::class])]
class Product extends Model
{
    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'content' => 'array',
            'colors' => 'array',
            'image_urls' => 'array',
            'is_active' => 'boolean'
        ];
    }
} 