<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Producto;

class MisProductosController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $productos = $user->productos;

        return view('my-products', compact('productos'));
    }
}
