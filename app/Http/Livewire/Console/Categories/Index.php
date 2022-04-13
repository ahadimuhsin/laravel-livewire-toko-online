<?php

namespace App\Http\Livewire\Console\Categories;

use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;

class Index extends Component
{
    use WithPagination;

    public $search;

    protected $updatesQueryString = ['search'];

    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        if($category)
        {
            Storage::disk('public')->delete('categories/'.$category->image);
            $category->delete();
        }
        session()->flash('success', 'Data sudah terhapus');
        return redirect()->route('categories.index');
    }

    public function render()
    {
        //kalo ada pencarian
        if($this->search != "")
        {
            $categories = Category::where('name', 'like', '%'.$this->search.'%')
            ->latest()->paginate(10);
        }
        else{
            $categories = Category::latest()->paginate(10);
        }

        return view('livewire.console.categories.index',
        compact('categories'));
    }
}
