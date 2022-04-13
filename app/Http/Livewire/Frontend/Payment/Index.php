<?php

namespace App\Http\Livewire\Frontend\Payment;

use App\Models\Invoice;
use App\Models\PaymentConfirmation;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    use WithFileUploads;

    public $invoice;
    public $invoice_id;
    public $customerId;
    public $name;
    public $phone;
    public $bank_transfer_from;
    public $bank_transfer_to;
    public $from_name;
    public $total;
    public $transfer_date;
    public $note;
    public $image;

    //mount or constructor
    public function mount($invoice_id)
    {
        $this->invoice = Invoice::where('invoice', $invoice_id)->first();

        // dd($invoice_id);

        $this->customerId = $this->invoice->customer_id;
        $this->invoice_id = $this->invoice->invoice;
        $this->name = $this->invoice->name;
        $this->phone = $this->invoice->phone;

        if(Auth::guard('customer')->user()->id != $this->customerId)
        {
            session()->flash('error', 'Anda tidak punya akses');
            return redirect()->route('root');
        }
    }

    public function confirmPayment()
    {
        $this->image->store('public/payments');

        $payment = PaymentConfirmation::create([
            'customer_id' => Auth::guard('customer')->user()->id,
            'name' => $this->name,
            'phone' => $this->phone,
            'invoice' => $this->invoice_id,
            'bank_transfer_from' => $this->bank_transfer_from,
            'bank_transfer_to' => $this->bank_transfer_to,
            'from_name' => $this->from_name,
            'total' => $this->total,
            'transfer_date' => $this->transfer_date,
            'image' => $this->image->hashName(),
            'note' => $this->note
        ]);

        //update status invoice
        Invoice::where('invoice', $this->invoice_id)->update([
            'status' => 'payment_review'
        ]);

        if($payment){
            session()->flash('success', 'Bukti Konfirmasi Pembayaran Berhasil Dikirim');
            redirect()->route('customer.orders');
        }
        else{
            session()->flash('error', 'Bukti Konfirmasi Pembayaran Gagal Dikirim');
            redirect()->back();
        }
    }

    public function render()
    {
        return view('livewire.frontend.payment.index');
    }
}
