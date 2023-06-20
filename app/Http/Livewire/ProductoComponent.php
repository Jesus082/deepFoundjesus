<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Producto;
use Livewire\Component;
use Illuminate\Support\Facades\Route;
use Livewire\WithFileUploads;
use App\Models\User;
use App\Models\Category;
use App\Models\Status;
use App\Models\Image;
use App\Models\Subcategory;

class ProductoComponent extends Component
{
    use WithFileUploads;

    /*Variables que usaremos en el formulario con livewire para insertar los datos en la tabla producto */
    public $name, $description, $price, $manufacturing, $category, $subcategory, $status;
    public $descriptionLength;
    public $newImage;
    public $categories = [], $subcategories = [], $statuses = [];
    public $images = [];
    public $autonomias;
    public $provincias;
    public $municipios;
    public $selectedAutonomia;
    public $selectedProvincia;
    public $selectedMunicipio;
    public function render()
    {
        return view('livewire.producto-component');
    }

    public function store()
    {
        /*Sacamos el usuario actualmente logeado */
        $user = User::find(auth()->id()); // Obtén la instancia del usuario basada en su id

        /*Validacion de los datos */
        $this->validate([
            'name' => ['required', 'string', 'min:3', 'max:30'],
            'description' => ['required', 'string', 'min:20', 'max:300'],
            'images' => ['required', 'array'],
            'images.*' => ['image', 'max:10000'],
            'price' => ['required', 'numeric', 'gt:0', 'lte:10000000'],
            'category' => ['required'],
            'subcategory' => ['required'],
            'status' => ['required'],
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
            'category.required' => 'El campo Categoría es obligatorio.',
            'subcategory.required' => 'El campo Subcategoría es obligatorio.',
            'status.required' => 'El campo Estado es obligatorio.',
        ]);

        /*Creamos un nuevo objeto producto y le asignamos todos los campos que debe tener */
        $producto = new Producto();
        $producto->name = $this->name;
        $producto->description = $this->description;
        $producto->price = $this->price;
        $producto->manufacturing = $this->manufacturing;
        $producto->autonomy = $this->selectedAutonomia;
        $producto->province = $this->selectedProvincia;
        $producto->municipality = $this->selectedMunicipio;
        $producto->user_id = $user->id;
        $producto->category_id = $this->category;
        $producto->subcategory_id = $this->subcategory;
        $producto->status_id = $this->status;
        $producto->save(); // Guarda el producto en la base de datos

        /*Recorremos el arrat de imagenes */
        foreach ($this->images as $key => $image) {
            /*Almacenamos la imagen y a una variable le asignamos su ruta de almacenamiento */
            $imageName = $image->storePublicly('public/images');
            /*Y almacenamos esa ruta en el modelo image asociado al producto */
            $producto->images()->create([
                'image' => $imageName,
            ]);
        }

        /*Guardamos la relacion entre el usuario y el producto */
        $user->productos()->save($producto);
        /*Reniciamos las imagenes y todos los demas campos ya que en livewire al no hacer falta recargar la pagina
        para almacenar el producto si no reseteamos los campos, se quedaran iguales cuando almacenemos el producto */
        $this->images = [];
        session()->flash('success', 'Producto subido exitosamente');
        $this->reset(['name', 'description', 'price', 'category', 'subcategory', 'selectedProvincia', 'selectedAutonomia', 'selectedMunicipio', 'status', 'manufacturing']);
    }

    /*Este metodo se ejecutara automaticamente al subir una nueva image, se ejecuta solo devido al espacio de nombres de livewire.
    Como tenemos un modelo asignadmo al input file en el formulario llamada newImage, al crear una funcion que se llama igual
    pero tiene Update delante, se ejecutara automaticamente cuando detecte que newDate se modifica*/
    public function updatedNewImage()
    {
        /*Comprueba si hay una nueva imagen y la almacena en el array de imagenes */
        if ($this->newImage) {
            $this->images[] = $this->newImage;
            $this->newImage = null;
        }
    }

    /*este metodo se ejecuta automaticamente por livewire, sirve para montar los datos necesarios. En este caso
    montamos los estados del producto y las categorias para que luego se vean en el select del formulario */
    public function mount()
    {
        $this->selectedAutonomia = null;
        $this->selectedProvincia = null;
        $this->selectedMunicipio = '';

        $autonomiasJson = file_get_contents(public_path('ubicaciones/autonomias.json'));
        $provinciasJson = file_get_contents(public_path('ubicaciones/provincias-aut.json'));
        $municipiosJson = file_get_contents(public_path('ubicaciones/municipios.json'));


        $this->autonomias = collect(json_decode($autonomiasJson, true));
        $this->provincias = collect(json_decode($provinciasJson, true));
        $this->municipios = collect(json_decode($municipiosJson, true));

        $this->statuses = Status::all();
        $this->categories = Category::all();
        $this->subcategories = collect();
    }

    /*funcion igual que la de newImage, esta se asocia a la categoria y lo que hace es que al seleccionar una categoria,
    automaticamente busca todas las subcategorias asociada a esta */
    public function updatedCategory($id)
    {
        $this->subcategories = Subcategory::where('category_id', $id)->get();
        $this->subcategory = $this->subcategories->first()->id ?? null;
    }

    /*Funcion que sirve para quitar imagenes de las que hemos añadido */
    public function removeMe($id)
    {
        array_splice($this->images, $id, 1);
    }

    /*Funcion para obtener el numero de caracteres en tiempo real que se estan escribiendo en el campo descripcion */
    public function updatedDescription()
    {
        $this->descriptionLength = strlen($this->description);
    }

    /*Funcion que comprueba que si el numero de caracteres en la descripcion ha exedido de 300, no deje escribir mas de eso */
    public function checkDescriptionLength()
    {
        $maxLength = 300;
        $this->description = mb_substr($this->description, 0, $maxLength);
    }

    public function updatedSelectedAutonomia()
    {
        $this->selectedProvincia = '';
    }

}
