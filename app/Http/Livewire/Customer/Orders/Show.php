<?php

namespace App\Http\Livewire\Customer\Orders;

use App\Models\Invoice;
use Livewire\Component;

class Show extends Component
{
    public $invoice;

    public function mount($id){
        $this->invoice = Invoice::find($id);
    }
    
    public function render()
    {
        return view('livewire.customer.orders.show');
    }
}
