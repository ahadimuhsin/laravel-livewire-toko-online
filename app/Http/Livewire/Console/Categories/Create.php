<?php

namespace App\Http\Livewire\Console\Categories;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class Create extends Component
{
    //trait livewire fileupload
    use WithFileUploads;
    /*
    global variable
    */
    public $name;
    public $image;

    public function store()
    {
        //form validation
        $this->validate([
            'image' => 'required|image',
            'name' => 'required'
        ]);
        //folder tempat simpan image
        $this->image->store('public/categories');

        //buat data baru di tabel kategori
        $category = Category::create([
            'name' => $this->name,
            'slug' => Str::slug($this->name, '-'),
            'image' => $this->image->hashName()
        ]);

        if($category){
            session()->flash('success', 'Data berhasil disimpan');
        }
        else{
            session()->flash('error', 'Data gagal disimpan');
        }
        return redirect()->route('categories.index');
    }
    public function render()
    {
        return view('livewire.console.categories.create');
    }
}
