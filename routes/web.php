<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\ProductoComponent;
use App\Http\Controllers\InicioController;
use App\Http\Livewire\MyProductsComponent;
use App\Http\Livewire\ProductViewComponent;
use App\Http\Livewire\EditProductComponent;
use App\Http\Controllers\searchProductsController;
use GuzzleHttp\Client;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/', [InicioController::class, 'index'])->name('dashboard');
    Route::view('/subir-producto', 'subir-producto')->name('subir-producto');
    Route::view('/mis-productos', 'my-products')->name('mis-productos');
    Route::view('/editar-producto/{id}', 'editar-producto')->name('editar-producto');
    Route::view('/item/{id}', 'item')->name('item');
    Route::view('/user/{id}', 'layouts.users')->name("users-menu");
    Route::view('/user/{id}/productos', 'user-products')->name("user-products");
    Route::view('/guardados', 'products-save')->name("guardados");
    Route::view('/search_products', 'search_products')->name("search_products");
    Route::get('/search_products', [searchProductsController::class, 'index'])->name('search_products');
    Route::get('/mapa', function () {
        return view('mapa');
    });
});



use App\Http\Controllers\MapaController;

Route::get('/mapa', function () {
    return view('mapa');
});
