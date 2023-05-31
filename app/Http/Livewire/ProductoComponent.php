<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Producto;
use Livewire\Component;
use Illuminate\Support\Facades\Route;
use Livewire\WithFileUploads;
use App\Models\User;
use App\Models\Category;
use App\Models\Image;
use App\Models\Subcategory;
class ProductoComponent extends Component
{
    use WithFileUploads;

    public $name, $description, $price;
    public $category, $subcategory;
    public $newImage;
    public $categories = [], $subcategories = [];
    public $images = [];

    public function render()
    {
        return view('livewire.producto-component');
    }

    public function store()
    {
        $user = User::find(auth()->id()); // Obtén la instancia del usuario basada en su id

        $producto = new Producto();

        $producto->name = $this->name;
        $producto->description = $this->description;
        $producto->price = $this->price;
        $producto->user_id = $user->id;
        $producto->category_id = $this->category;
        $producto->subcategory_id = $this->subcategory;
        $producto->save(); // Guarda el producto en la base de datos

        foreach ($this->images as $key => $image) {
            //dd($image);
            $imageName = $image->store('public/images');
            $producto->images()->create([
                'image' => $imageName,
            ]);
        }

        $user->productos()->save($producto); // Guarda la relación entre el usuario y el producto
        $this->images = []; // Reinicia el array de imágenes después de guardar el producto
        session()->flash('success', 'Producto subido exitosamente');
        $this->reset(['name', 'description', 'price', 'category', 'subcategory']);
    }

    public function updatedNewImage()
    {
        if ($this->newImage) {
            $this->images[] = $this->newImage;
            $this->newImage = null;
        }
    }

    public function mount()
    {
        $this->categories = Category::all();
        $this->subcategories = collect();
    }

    public function updatedCategory($id){
        $this->subcategories = Subcategory::where('category_id', $id)->get();
        $this->subcategory = $this->subcategories->first()->id ?? null;
    }

    public function removeMe($id)
    {
        array_splice($this->images, $id, 1);
    }
}
