<?php

namespace App\Http\Livewire;
use App\Models\Producto;
use Livewire\Component;

class AllProductsComponent extends Component
{
    public function render()
    {
        $productos = Producto::all();

        return view('livewire.all-products-component', compact('productos'));
    }
}
