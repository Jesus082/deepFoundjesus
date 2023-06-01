<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Validator;
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
    public $descriptionLength;
    public $newImage;
    public $categories = [], $subcategories = [];
    public $images = [];

    public function rules()
    {
        return [
            'message' => 'max:100',
        ];
    }

    public function render()
    {
        return view('livewire.producto-component');
    }

    public function store()
    {
        $user = User::find(auth()->id()); // Obtén la instancia del usuario basada en su id

        $this->validate([
            'name' => ['required', 'string', 'min:3', 'max:30'],
            'description' => ['required', 'string', 'min:20', 'max:300'],
            'images' => ['required', 'array'],
            'images.*' => ['image', 'max:2048'],
            // La imagen debe ser una imagen válida y tener un tamaño máximo de 2MB
            'price' => ['required', 'numeric', 'gt:0', 'lte:10000000'],
        ], [
                'name.required' => 'El nombre es requerido.',
                'name.min' => 'El nombre debe tener al menos :min caracteres.',
                'name.max' => 'El nombre no puede tener más de :max caracteres.',
                'description.required' => 'La descripción es requerida.',
                'description.min' => 'La descripción debe tener al menos :min caracteres.',
                'description.max' => 'La descripción no puede tener más de :max caracteres.',
                'images.required' => 'Debe seleccionar al menos una imagen.',
                'images.array' => 'El campo de imágenes debe ser un arreglo.',
                'images.*.image' => 'El archivo debe ser una imagen válida.',
                'images.*.max' => 'El tamaño máximo de la imagen es de 2MB.',
                'price.required' => 'El precio es requerido.',
                'price.numeric' => 'El precio debe ser un valor numérico.',
                'price.gt' => 'El precio debe ser mayor que 0.',
                'price.lte' => 'El precio no puede ser mayor a 10,000,000.',
            ]);


        $producto = new Producto();
        $producto->name = $this->name;
        $producto->description = $this->description;
        $producto->price = $this->price;
        $producto->user_id = $user->id;
        $producto->category_id = $this->category;
        $producto->subcategory_id = $this->subcategory;
        $producto->save(); // Guarda el producto en la base de datos

        foreach ($this->images as $key => $image) {
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

    public function updatedCategory($id)
    {
        $this->subcategories = Subcategory::where('category_id', $id)->get();
        $this->subcategory = $this->subcategories->first()->id ?? null;
    }

    public function removeMe($id)
    {
        array_splice($this->images, $id, 1);
    }

    public function updatedDescription()
    {
        $this->descriptionLength = strlen($this->description);
    }
    public function checkDescriptionLength()
    {
        $maxLength = 300;
        $this->description = mb_substr($this->description, 0, $maxLength);
    }
}
