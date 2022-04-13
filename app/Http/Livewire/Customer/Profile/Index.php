<?php

namespace App\Http\Livewire\Customer\Profile;

use Livewire\Component;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    public $customerId;
    public $name;
    public $email;
    public $password;

    public function mount()
    {
        $this->customerId = Auth::guard('customer')->user()->id;
        $this->name = Auth::guard('customer')->user()->name;
        $this->email = Auth::guard('customer')->user()->email;

    }

    public function update()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|unique:customers,email,'.$this->customerId
        ]);

        $customer = Customer::find($this->customerId);

        if($customer){
            if($this->password == ""){
                $customer->update([
                    'name' => $this->name,
                    'email' => $this->email
                ]);
            }
            else{
                $customer->update([
                    'name' => $this->name,
                    'email' => $this->email,
                    'password' => bcrypt($this->password)
                ]);
            }

            session()->flash('success', 'Data berhasil diperbarui');
            return redirect()->route('customer.profile');
        }
    }

    public function render()
    {
        return view('livewire.customer.profile.index');
    }
}
