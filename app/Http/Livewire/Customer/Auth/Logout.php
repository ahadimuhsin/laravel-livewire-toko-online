<?php

namespace App\Http\Livewire\Customer\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Logout extends Component
{
    public function logout()
    {
        Auth::guard('customer')->logout();
        return redirect()->route('auth.customer.login');
    }
    public function render()
    {
        return view('livewire.customer.auth.logout');
    }
}
