<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use App\Models\User;

use Illuminate\Notifications\Notifiable;
use App\Notifications\ResetPassword;

class ForgotPassword extends Component
{
    use Notifiable;

    public $email = '';

    public $showSuccesNotification = false; 
    public $showFailureNotification = false;

    public $showDemoNotification = false;

    protected $rules = [
        'email' => 'required|email',
    ];  

    public function mount() {
        if(auth()->user()){
            redirect()->route('dashboard');
        }
    }

    public function routeNotificationForMail() {
        return $this->email;
    }

    public function recoverPassword() {
        $this->validate();
        $user = User::where('email', $this->email)->first();
        if($user){
            $this->notify(new ResetPassword($user->id));
            $this->showSuccesNotification = true;
            $this->showFailureNotification = false;
        } else {
            $this->showFailureNotification = true;
        }
    }

    public function render()
    {
        return view('livewire.auth.forgot-password')->layout('layouts.dashboard.base');
    }
}
