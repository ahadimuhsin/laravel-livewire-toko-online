<?php

namespace App\Http\Livewire\Console\Sliders;

use App\Models\Slider;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Index extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $image;
    public $link;

    public function store()
    {
        $this->validate([
            'image' => 'required|image',
            'link' => 'required'
        ]);

        $this->image->store('public/sliders');

        $slider = Slider::create([
            'link' => $this->link,
            'image' => $this->image->hashName()
        ]);

        if($slider){
            session()->flash('success', 'Data berhasil disimpan');
        }
        else{
            session()->flash('error', 'Data gagal disimpan');
        }
        return redirect()->route('sliders.index');
    }

    public function destroy($id)
    {
        $slider = Slider::find($id);

        if($slider){
            Storage::disk('public')->delete('sliders/'.$slider->image);
            $slider->delete();
        }

        session()->flash('success', 'Data berhasil dihapus');

        return redirect()->route('sliders.index');
    }

    public function render()
    {
        return view('livewire.console.sliders.index', [
            'sliders' => Slider::latest()->paginate(2)
        ]);
    }
}
