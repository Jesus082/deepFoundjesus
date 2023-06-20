<?php

namespace App\Http\Livewire;
use App\Models\User;
use App\Models\Producto;

use Livewire\Component;

class UserProductsComponent extends Component
{
    public $user;

    public function render()
    {
        $products = $this->user->productos()->with('category', 'subcategory', 'images')->get();
        return view('livewire.user-products-component', compact('products'));
    }

    public function mount($id)
    {
        $this->user = User::find($id);
    }
}
