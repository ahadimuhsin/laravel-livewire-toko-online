<?php

namespace App\Http\Livewire\Console\Vouchers;

use App\Models\Voucher;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;

class Index extends Component
{
    use WithPagination;

    public $search;

    protected $updatesQueryString = ['search'];

    public function destroy($id)
    {
        $voucher = Voucher::findOrFail($id);

        if($voucher)
        {
            Storage::disk('public')->delete('vouchers/'.$voucher->image);
            $voucher->delete();
        }

        session()->flash('success', 'Data berhasil dihapus');
        return redirect()->route('vouchers.index');
    }


    public function render()
    {
        if($this->search != ''){
            $vouchers = Voucher::where('title', 'like', '%'. $this->search.'%')
            ->latest()->paginate(10);
        }
        else{
            $vouchers = Voucher::latest()->paginate(10);
        }

        return view('livewire.console.vouchers.index', compact('vouchers'));
    }
}
