<?php

namespace App\Http\Livewire;

use App\Models\Producto;
use App\Models\Category;
use App\Models\Subcategory;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Illuminate\Support\Facades\Route;
use Livewire\WithFileUploads;
use App\Models\User;
use App\Models\Image;
use App\Models\Status;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;


class EditProductComponent extends Component

{
    use WithFileUploads;
    public $product, $name, $description, $price, $status, $category, $subcategory, $newImage;
    public $autonomias, $provincias, $municipios;
    public $manufacturing;
    public $selectedAutonomia, $selectedProvincia, $selectedMunicipio;
    public $categories = [], $subcategories = [];
    public $images = [], $tmpImages = [];
    public $statuses = [];
    public $descriptionLength;

    public function render()
    {
        return view('livewire.edit-product-component');
    }

    public function mount($id)
    {
        $this->selectedAutonomia = '';
        $this->selectedProvincia = '';
        $this->selectedMunicipio = '';

        $autonomiasJson = file_get_contents(public_path('ubicaciones/autonomias.json'));
        $provinciasJson = file_get_contents(public_path('ubicaciones/provincias-aut.json'));
        $municipiosJson = file_get_contents(public_path('ubicaciones/municipios.json'));

        $this->autonomias = collect(json_decode($autonomiasJson, true));
        $this->provincias = collect(json_decode($provinciasJson, true));
        $this->municipios = collect(json_decode($municipiosJson, true));
        // Cargar el producto a partir del ID
        $this->product = Producto::find($id);

        $this->name = $this->product->name;
        $this->description = $this->product->description;
        $this->price = $this->product->price;
        $this->manufacturing = $this->product->manufacturing;
        $this->selectedAutonomia = $this->product->autonomy;
        $this->selectedProvincia = $this->product->province;
        $this->selectedMunicipio = $this->product->municipality;
        $this->category = $this->product->category_id;
        $this->status = $this->product->status_id;
        $this->images = $this->product->images->toArray();
        $this->categories = Category::all();
        $this->updatedCategory($this->category);
        $this->subcategory = $this->product->subcategory_id;
        $this->statuses = Status::all();

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


        $this->product->name = $this->name;
        $this->product->description = $this->description;
        $this->product->price = $this->price;
        $this->product->manufacturing = $this->manufacturing;
        $this->product->autonomy = $this->selectedAutonomia;
        $this->product->province = $this->selectedProvincia;
        $this->product->municipality = $this->selectedMunicipio;
        $this->product->category_id = $this->category;
        $this->product->status_id = $this->status;
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
