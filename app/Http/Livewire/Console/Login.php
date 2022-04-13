<?php

namespace App\Http\Livewire\Console;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Login extends Component
{
    /*
    global variable
    */
    public $email;
    public $password;

    /*
    login function
    */

    public function login()
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(Auth::attempt(['email' => $this->email, 'password' => $this->password])){
            return redirect()->route('dashboard');
        }
        else{
            session()->flash('error', 'Email atau Password Salah');
            // echo "AAAA";
            // dd(session());
            return redirect()->route('login');
        }
    }

    public function render()
    {
        return view('livewire.console.login');
    }
}
