<?php

namespace App\Http\Livewire\Console\Users;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class Create extends Component
{
    public $name;
    public $email;
    public $password;
    public $password_confirmation;

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|unique:users|email',
            'password' => 'required|confirmed'
        ]);

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password)
        ]);

        if($user){
            session()->flash('success', 'User berhasil disimpan');
        }else{
            session()->flash('error', 'User gagal disimpan');
        }

        return redirect()->route('users.index');
    }

    public function render()
    {
        return view('livewire.console.users.create');
    }
}
