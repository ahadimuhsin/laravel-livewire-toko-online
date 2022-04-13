<?php

namespace App\Http\Livewire\Console\Products;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;

class Index extends Component
{
    use WithPagination;

    //global search
    public $search = '';

    protected $updatesQueryString = ['search'];

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if($product){
            Storage::disk('public')
            ->delete('products/'.$product->image);
            $product->delete();
        }

        session()->flash('success', 'Data berhasil dihapus');
        return redirect()->route('products.index');
    }

    public function render()
    {
        //kalo ada pencarian
        if($this->search != "")
        {
            $products = Product::where('title', 'like', '%'.$this->search.'%')
            ->latest()->paginate(10);
        }
        else{
            $products = Product::latest()->paginate(10);
        }
        return view('livewire.console.products.index', compact('products'));
    }
}
