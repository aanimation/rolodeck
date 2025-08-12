<?php

namespace App\Observers;

use App\Models\UserProfile as Profile;

class ProfileObserver
{
    /**
     * Handle the Profile "creating" event.
     */
    public function creating(Profile $item): void
    {
        $item->user_id = auth()->id();
    }

    /**
     * Handle the Profile "created" event.
     */
    public function created(Profile $item): void
    {
        //
    }

    /**
     * Handle the Profile "updated" event.
     */
    public function updated(Profile $item): void
    {
        //
    }

    /**
     * Handle the Profile "deleted" event.
     */
    public function deleted(Profile $item): void
    {
        //
    }

    /**
     * Handle the Profile "restored" event.
     */
    public function restored(Profile $item): void
    {
        //
    }

    /**
     * Handle the Profile "force deleted" event.
     */
    public function forceDeleted(Profile $item): void
    {
        //
    }
}
