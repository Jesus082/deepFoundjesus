<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class SubirProductosController extends Controller
{
    public function index()
    {
        return view('subir-producto');
    }
}
