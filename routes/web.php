<?php

use App\Http\Controllers\Dashboard;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', [App\Http\Controllers\Dashboard::class,'index']);

Route::resource('/users', UserController::class)->names('indexUsuarios');

Route::resource('compras', App\Http\Controllers\CompraController::class);
Route::resource('detalle_compras', App\Http\Controllers\DetalleCompraController::class);


Route::resource('productos', App\Http\Controllers\ProductoController::class);
Route::resource('tipo-proveedors', App\Http\Controllers\TipoProveedorController::class);
Route::resource('proveedores', App\Http\Controllers\ProveedoreController::class);
Route::resource('insumos', App\Http\Controllers\InsumoController::class);
Route::resource('clientes', App\Http\Controllers\ClienteController::class);
Route::resource('tipo-clientes', App\Http\Controllers\TipoClienteController::class);
Route::resource('ventas', App\Http\Controllers\VentaController::class);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
