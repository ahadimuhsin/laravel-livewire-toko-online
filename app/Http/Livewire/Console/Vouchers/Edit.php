<?php

namespace App\Http\Livewire\Console\Vouchers;

use App\Models\Voucher;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public $voucherId;
    public $title;
    public $voucher_name;
    public $nominal_voucher;
    public $total_minimal_shopping;
    public $content;
    public $image;

    public function mount($id)
    {
        $voucher = Voucher::find($id);

        if($voucher){
            $this->voucherId = $voucher->id;
            $this->title = $voucher->title;
            $this->voucher_name = $voucher->voucher;
            $this->nominal_voucher = $voucher->nominal_voucher;
            $this->total_minimal_shopping = $voucher->total_minimal_shopping;
            $this->content = $voucher->content;
        }
    }

    public function update()
    {
        $this->validate([
            'title' => 'required',
            'voucher_name' => 'required',
            'nominal_voucher' => 'required',
            'total_minimal_shopping' => 'required',
            'content' => 'required'
        ]);

        $voucher = Voucher::find($this->voucherId);

        if($voucher){
            if($this->image == null){
                $voucher->update([
                    'title' => $this->title,
                    'voucher' => $this->voucher_name,
                    'nominal_voucher' => $this->nominal_voucher,
                    'total_minimal_shopping' => $this->total_minimal_shopping,
                    'content' => $this->content
                ]);
            }
            else{
                $this->image->store('public/vouchers');
                $voucher->update([
                    'title' => $this->title,
                    'voucher' => $this->voucher_name,
                    'nominal_voucher' => $this->nominal_voucher,
                    'total_minimal_shopping' => $this->total_minimal_shopping,
                    'content' => $this->content,
                    'image' => $this->image->hashName()
                ]);
            }

            session()->flash('success', 'Data berhasil disimpan');
            return redirect()->route('vouchers.index');
        }
    }
    public function render()
    {
        return view('livewire.console.vouchers.edit');
    }
}
