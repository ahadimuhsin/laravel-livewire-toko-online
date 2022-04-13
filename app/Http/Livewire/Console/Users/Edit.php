<?php

namespace App\Http\Livewire\Console\Users;

use App\Models\User;
use Livewire\Component;

class Edit extends Component
{
    public $userId;
    public $name;
    public $email;
    public $password;
    public $password_confirmation;

    public function mount($id)
    {
        $user = User::find($id);

        if($user){
            $this->userId = $user->id;
            $this->name = $user->name;
            $this->email = $user->email;
        }
    }

    public function update()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$this->userId
        ]);

        $user = User::find($this->userId);

        if($this->password != "")
        {
            $user->update([
                'name' => $this->name,
                'email' => $this->email,
                'password' => bcrypt($this->password)
            ]);
        }
        else{
            $user->update([
                'name' => $this->name,
                'email' => $this->email
            ]);
        }
        session()->flash('success', 'User berhasil diperbarui');
        return redirect()->route('users.index');
    }

    public function render()
    {
        return view('livewire.console.users.edit');
    }
}
