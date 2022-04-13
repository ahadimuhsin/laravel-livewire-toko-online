<?php

namespace App\Http\Livewire\Console\Products;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    /*
    global variable
    */

    public $productId;
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

    /*
    mount or constructor function
    */

    public function mount($id)
    {
        $product= Product::findOrFail($id);

        if($product)
        {
            $this->productId = $product->id;
            $this->title = $product->title;
            $this->category_id = $product->category_id;
            $this->content = $product->content;
            $this->unit = $product->unit;
            $this->unit_weight = $product->unit_weight;
            $this->weight = $product->weight;
            $this->price = $product->price;
            $this->discount = $product->discount;
            $this->keywords = $product->keywords;
            $this->description = $product->description;
        }

    }

    //update function
    public function update()
    {
        $this->validate([
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

        $product = Product::findOrFail($this->productId);

        if($product){
            if($this->image == null)
            {
                $product->update([
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
            }
            else{
                $this->image->store('public/products');

                $product->update([
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
            }

            session()->flash('success', 'Data berhasil diupdate');
            return redirect()->route('products.index');
        }
    }
    public function render()
    {
        return view('livewire.console.products.edit', [
            'categories' => Category::latest()->get()
        ]);
    }
}
