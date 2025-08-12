<?php

namespace App\Http\Livewire\Auth;

use App\Http\Livewire\Auth;
use Livewire\Component;

class Logout extends Component
{
    public function logout() {
        try {
            auth()->logout();
        } catch(\Exception $e) {
            \Log::error($e->getMessage());
        }

        return route('catalogue');
    }

    public function render()
    {
        return view('livewire.auth.logout');
    }
}
