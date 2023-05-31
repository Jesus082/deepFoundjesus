<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\ProductoComponent;
use App\Http\Livewire\MyProductsComponent;
use App\Http\Livewire\EditProductComponent;
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
    Route::view('/dashboard', 'dashboard')->name('dashboard');
    Route::view('/subir-producto', 'subir-producto')->name('subir-producto');
    Route::view('/mis-productos', 'my-products')->name('mis-productos');
    Route::view('/editar-producto/{id}', 'editar-producto')->name('editar-producto');
});
