<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class InicioController extends Controller
{
    public function index()
    {
        $productos = Producto::all();

        return view('dashboard', compact('productos'));
    }
}
