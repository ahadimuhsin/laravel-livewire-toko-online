<?php

namespace App\Http\Livewire\Console\Categories;

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
    public $categoryId;
    public $name;
    public $image;

    public function mount($id)
    {
        $category = Category::findOrFail($id);

        if($category)
        {
            $this->categoryId = $category->id;
            $this->name = $category->name;
        }
    }

    //update function
    public function update()
    {
        $this->validate([
            'name' => 'required'
        ]);

        $category = Category::findOrFail($this->categoryId);

        if($category){
            if($this->image == null)
            {
               $category->update([
                   'name' => $this->name,
                   'slug' => Str::slug($this->name, '-')
               ]);
            }
            else{
                $this->image->store('public/categories');

                $category->update([
                    'name' => $this->name,
                    'slug' => Str::slug($this->name, '-'),
                    'image' => $this->image->hashName()
                ]);
            }

            session()->flash('success', 'Data berhasil diperbarui');
            return redirect()->route('categories.index');
        }
    }

    public function render()
    {
        return view('livewire.console.categories.edit');
    }
}
