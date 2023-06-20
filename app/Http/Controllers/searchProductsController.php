<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class searchProductsController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $categoryFilter = $request->input('categoryFilter');

        return view('search_products', compact('search', 'categoryFilter'));
    }
}
