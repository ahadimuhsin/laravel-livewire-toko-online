<?php

namespace App\Http\Livewire\Customer\Auth;

use Livewire\Component;
use App\Models\Customer;

class Register extends Component
{
    public $name;
    public $email;
    public $password;
    public $password_confirmation;

    public function register()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:customers',
            'password' => 'required|confirmed'
        ]);

        $customer = Customer::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password)
        ]);

        session()->flash('success', 'Register Berhasil');
        return redirect()->route('login');
    }
    public function render()
    {
        return view('livewire.customer.auth.register');
    }
}
