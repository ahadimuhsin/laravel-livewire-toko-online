<?php

namespace App\Http\Livewire\Console\Orders;

use App\Models\Invoice;
use Livewire\Component;

class Show extends Component
{
    public $invoice;

    public function mount($id)
    {
        $this->invoice = Invoice::find($id);
    }
    public function render()
    {
        return view('livewire.console.orders.show');
    }
}
