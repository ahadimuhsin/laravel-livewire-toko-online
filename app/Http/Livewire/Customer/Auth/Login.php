<?php

namespace App\Http\Livewire\Customer\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Login extends Component
{
    public $email;
    public $password;

    public function login()
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(Auth::guard('customer')
        ->attempt(['email' => $this->email,
        'password' => $this->password])){
            return redirect()->route('customer.dashboard');
        }
        else{
            session()->flash('error', 'Email atau Password salah');
            return redirect()->route('auth.login');
        }
    }
    
    public function render()
    {
        return view('livewire.customer.auth.login');
    }
}
