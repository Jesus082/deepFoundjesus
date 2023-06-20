<?php

namespace App\Http\Livewire;

use App\Models\Producto;
use App\Models\Image;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class MyProductsComponent extends Component
{
    public $products;
    public $user;
    public $saleStatus;
    protected $queryString = ['saleStatus'];

    public function render()
    {
        /*Hacemos una consulta u otra dependiendo del valor de saleStatus */
        if ($this->saleStatus === 'reserved') {
            $this->products = Producto::with('images')->where('reserved', true)->get();
        } elseif ($this->saleStatus === 'sold') {
            $this->products = Producto::with('images')->where('sold', true)->get();
        } else {
            $this->products = $this->user->productos()->get();
        }

        $isUserProductsRoute = true;

        return view('livewire.my-products-component', compact('isUserProductsRoute'));
    }
    public function mount()
    {
        $this->user = Auth::user();
        $this->products = $this->user->productos()->get();
    }

    public function deleteProduct($id)
    {
        $product = Producto::find($id);
        $product->delete();
    }

    public function is_reserved($id)
    {
        $product = Producto::find($id);
        if ($product->sold) {
            $product->sold = false;
        }
        if ($product->reserved) {
            $product->reserved = false;
        } else {
            $product->reserved = true;
        }
        $product->save();
        $this->mount(); // Actualizar los datos
        $this->render();
    }

    public function is_sold($id)
    {
        $product = Producto::find($id);
        if ($product->reserved) {
            $product->reserved = false;
        }
        if ($product->sold) {
            $product->sold = false;
        } else {
            $product->sold = true;
        }
        $product->save();
        $this->mount(); // Actualizar los datos
        $this->render();
    }
}
