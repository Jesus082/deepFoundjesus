<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
class UserComponent extends Component
{
    public $user;
    public function render()
    {
        return view('livewire.user-component');
    }

    public function mount($id)
    {
        $this->user = User::find($id);
    }
}
