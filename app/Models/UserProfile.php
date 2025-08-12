<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Observers\ProfileObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
 
// #[ObservedBy([ProfileObserver::class])]
class UserProfile extends Model
{
    protected $guarded      = ['id'];
    protected $hidden       = ['created_at', 'updated_at', 'deleted_at'];
}
