<?php

namespace App\Http\Livewire\Console\Orders;

use App\Models\Invoice;
use Livewire\Component;

class Receipt extends Component
{

    public $receipt;
    public $invoiceId;

    public function mount($id)
    {
        $invoice = Invoice::find($id);
        $this->invoiceId = $invoice->id;
    }

    public function update()
    {
        $invoice = Invoice::find($this->invoiceId);

        if($invoice)
        {
            $invoice->update([
                'no_resi' => $this->receipt
            ]);

            session()->flash('success', 'Status berhasil diubah');
            return redirect()->route('orders.index');
        }
    }
    public function render()
    {
        return view('livewire.console.orders.receipt');
    }
}
