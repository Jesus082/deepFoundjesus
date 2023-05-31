<?php

namespace App\Http\Livewire;

use App\Models\Producto;
use App\Models\Category;
use App\Models\Subcategory;


use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Facades\Route;
use Livewire\WithFileUploads;
use App\Models\User;
use App\Models\Image;


class EditProductComponent extends Component

{
    use WithFileUploads;
    public $product, $name, $description, $price, $category, $subcategory, $newImage;
    public $categories = [], $subcategories = [];
    public $images = [], $tmpImages = [];

    public function render()
    {
        return view('livewire.edit-product-component');
    }

    public function mount($id)
    {
        // Cargar el producto a partir del ID
        $this->product = Producto::find($id);

        $this->name = $this->product->name;
        $this->description = $this->product->description;
        $this->price = $this->product->price;
        $this->category = $this->product->category_id;
        $this->images = $this->product->images->toArray();
        $this->categories = Category::all();
        $this->updatedCategory($this->category);
        $this->subcategory = $this->product->subcategory_id;
    }

    public function updatedCategory($id)
    {
        $this->subcategories = Subcategory::where('category_id', $id)->get();
        $this->subcategory = $this->subcategories->first()->id ?? null;
    }

    public function updatedNewImage()
    {
        if ($this->newImage) {
            $this->tmpImages[] = $this->newImage;
            $this->newImage = null;
        }
    }

    public function removeImg($id)
    {
        unset($this->images[$id]);
        $this->images = array_values($this->images);
    }

    public function removeImgTmp($id)
    {
        unset($this->tmpImages[$id]);
    }

    public function updateProduct($id){

        $user = User::find(auth()->id());
        $this->product->name = $this->name;
        $this->product->description = $this->description;
        $this->product->price = $this->price;
        $this->product->category_id = $this->category;
        $this->product->subcategory_id = $this->subcategory;

        $this->product->images()->delete();

        foreach ($this->images as $imageData) {
            $this->product->images()->create([
                'image' => $imageData['image'],
            ]);
        }

        foreach ($this->tmpImages as $key => $image) {
            $imageName2 = $image->store('public/images');
            $this->product->images()->create([
                'image' => $imageName2,
            ]);
        }

        $this->product->save();

        return redirect()->route('mis-productos');
    }
}
