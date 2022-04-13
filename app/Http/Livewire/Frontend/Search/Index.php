<?php

namespace App\Http\Livewire\Frontend\Search;

use App\Facades\Cart;
use App\Models\Product;

use Livewire\Component;
use Illuminate\Http\Request;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search;
    public $perPage = 12;

    public function mount(Request $request)
    {
        $this->search = $request->input('q');

        if($this->search == "")
        {
            return redirect()->route('root');
        }
    }

    public function addToCart(int $productId)
    {
        Cart::add(Product::where('id', $productId)->first());
        $this->emit('addToCart');

        //alert message
        $this->emit('alert', ['type' => 'success', 'message' => 'Produk berhasil dimasukkan ke keranjang']);
    }

    public function loadMore()
    {
        $this->perPage = $this->perPage + 4;
    }

    public function render()
    {
        $products = Product::where('title', 'like', '%'.$this->search.'%')
        ->latest()->paginate($this->perPage);

        return view('livewire.frontend.search.index',
    [
        'products' => $products
        ]);
    }
}
