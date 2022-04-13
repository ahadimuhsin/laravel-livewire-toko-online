<?php

namespace App\Http\Livewire\Console\Vouchers;

use App\Models\Voucher;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $title;
    public $voucher_name;
    public $nominal_voucher;
    public $total_minimal_shopping;
    public $content;
    public $image;

    public function store()
    {
        $this->validate([
            'image' => 'required|image',
            'title' => 'required',
            'voucher_name' => 'required',
            'nominal_voucher' => 'required',
            'total_minimal_shopping' => 'required',
            'content' => 'required'
        ]);

        $this->image->store('public/vouchers');

        $voucher = Voucher::create([
            'title' => $this->title,
            'voucher' => $this->voucher_name,
            'nominal_voucher' => $this->nominal_voucher,
            'total_minimal_shopping' => $this->total_minimal_shopping,
            'content' => $this->content,
            'image' => $this->image->hashName()
        ]);

        if($voucher){
            session()->flash('success', 'Data berhasil disimpan');
        }
        else{
            session()->flash('error', 'Data gagal disimpan');
        }

        return redirect()->route('vouchers.index');
    }
    public function render()
    {
        return view('livewire.console.vouchers.create');
    }
}
