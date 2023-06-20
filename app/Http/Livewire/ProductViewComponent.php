<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Producto;
class ProductViewComponent extends Component
{
    public $product;
    public $GetNameAutonomia;
    public $GetNameProvincia;
    public $GetNameMunicipio;

    public $autonomias, $provincias, $municipios;

    public $nombreAutonomia, $nombreProvincia, $nombreMunicipio;
    public function render()
    {
        return view('livewire.product-view-component');
    }

    public function mount($id)
    {
        $this->product = Producto::find($id);

        $autonomiasJson = file_get_contents(public_path('ubicaciones/autonomias.json'));
        $provinciasJson = file_get_contents(public_path('ubicaciones/provincias-aut.json'));
        $municipiosJson = file_get_contents(public_path('ubicaciones/municipios.json'));

        $this->autonomias = collect(json_decode($autonomiasJson, true));
        $this->provincias = collect(json_decode($provinciasJson, true));
        $this->municipios = collect(json_decode($municipiosJson, true));

        $autonomia = $this->autonomias->firstWhere('autonomia_id', $this->product->autonomy);
        $provincia = $this->provincias->firstWhere('provincia_id', $this->product->province);
        $municipio = $this->municipios->firstWhere('municipio_id', $this->product->municipality);

        $this->nombreAutonomia = $autonomia ? $autonomia['nombre'] : null;
        $this->nombreProvincia = $provincia ? $provincia['nombre'] : null;
        $this->nombreMunicipio = $municipio ? $municipio['nombre'] : null;

        $this->GetNameAutonomia = $this->nombreAutonomia;
        $this->GetNameProvincia = $this->nombreProvincia;
        $this->GetNameMunicipio = $this->nombreMunicipio;
    }
}
