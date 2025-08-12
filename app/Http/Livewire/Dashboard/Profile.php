<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;

use App\Models\User;

class Profile extends Component
{   
    public function render()
    {
        return view('livewire.dashboard.profile');
    }
}
