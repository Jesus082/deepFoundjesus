<?php

namespace App\Http\Livewire;
use App\Models\Producto;
use App\Models\Image;
use Illuminate\Support\Facades\Auth;

use Livewire\Component;

class MyProductsComponent extends Component
{

    public $name, $description, $price;
    public $category, $subcategory;
    public $categories = [], $subcategories = [];
    public $images = [];

    public function render()
    {
        $isUserProductsRoute = true;
        $user = Auth::user();
        $products = $user->productos()->with('category', 'subcategory', 'images')->get();


        return view('livewire.my-products-component', compact('products', 'isUserProductsRoute'));
    }

    public function deleteProduct($id){
        $product = Producto::find($id);
        dd();
        $product->delete();
    }

}
