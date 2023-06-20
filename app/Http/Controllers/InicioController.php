<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Category;

use function GuzzleHttp\Promise\all;

class InicioController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $productos = Producto::all();

        return view('dashboard', compact('productos', 'categories'));
    }
}
