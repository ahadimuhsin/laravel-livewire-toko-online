<?php

namespace App\Http\Livewire\Console\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search;

    protected $updatesQueryString = ['search'];

    public function destroy($id)
    {
        $user = User::find($id);

        if($user){
            $user->delete();
        }

        session()->flash('success', 'User berhasil dihapus');
        return redirect()->route('users.index');
    }

    public function render()
    {
        if($this->search != "")
        {
            $users = User::where('name', 'like', '%'.$this->search.'%')
            ->latest()->paginate(10);
        }
        else{
            $users = User::latest()->paginate(10);
        }
        return view('livewire.console.users.index', compact('users'));
    }
}
