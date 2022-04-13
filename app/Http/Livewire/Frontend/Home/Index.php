<?php

namespace App\Http\Livewire\Frontend\Home;

use App\Facades\Cart;
use App\Models\Slider;
use App\Models\Product;
use Livewire\Component;

class Index extends Component
{
    public $perPage = 12;

    public function loadMore()
    {
        $this->perPage = $this->perPage + 4;
    }

    public function addToCart(int $productId)
    {
        Cart::add(Product::where('id', $productId)->first());
        $this->emit('addToCart');

        //alert message
        $this->emit('alert', [
            'type' => 'success', 'message' => 'Product added to cart']);
    }
    public function render()
    {
        $products = Product::latest()->paginate($this->perPage);
        return view('livewire.frontend.home.index', [
            'sliders' => Slider::latest()->get(),
            'products' => $products
        ]);
    }
}
