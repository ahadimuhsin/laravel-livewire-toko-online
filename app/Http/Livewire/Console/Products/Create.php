<?php

namespace App\Http\Livewire\Console\Products;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    /*
    global variable
    */

    public $image;
    public $title;
    public $category_id;
    public $content;
    public $unit;
    public $unit_weight;
    public $weight;
    public $price;
    public $discount;
    public $keywords;
    public $description;

    public function store()
    {
        $this->validate([
            'image' => 'required|image',
            'title' => 'required',
            'category_id' => 'required',
            'content' => 'required',
            'unit' => 'required',
            'unit_weight' => 'required',
            'weight' => 'required',
            'price' => 'required',
            'discount' => 'required',
            'keywords' => 'required',
            'description' => 'required'
        ]);

        $this->image->store('public/products');

        $product = Product::create([
            'image' => $this->image->hashName(),
            'title' => $this->title,
            'slug' => Str::slug($this->title, '-'),
            'category_id' => $this->category_id,
            'content' => $this->content,
            'unit' => $this->unit,
            'unit_weight' => $this->unit_weight,
            'weight' => $this->weight,
            'price' => $this->price,
            'discount' => $this->discount,
            'keywords' => $this->keywords,
            'description' => $this->description
        ]);

        if($product)
        {
            session()->flash('success', 'Data berhasil disimpan');
        }
        else{
            session()->flash('error', 'Data gagal disimpan');
        }

        return redirect()->route('products.index');
    }
    public function render()
    {
        return view('livewire.console.products.create', [
            'categories' => Category::latest()->get()
        ]);
    }
}
