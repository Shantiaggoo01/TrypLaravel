<?php

use App\Http\Controllers\Dashboard;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;


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
})->middleware('auth');
Route::get('/dashboard', [App\Http\Controllers\Dashboard::class,'index'])->middleware('auth');


Route::group(['middleware'=>['auth']],function(){

Route::resource('usuarios', App\Http\Controllers\UsuarioController::class)->middleware('auth');
Route::resource('roles', App\Http\Controllers\RolController::class)->middleware('auth');
Route::resource('proveedores',App\Http\Controllers\ProveedoreController::class)->middleware('auth');
Route::resource('compras', App\Http\Controllers\CompraController::class)->middleware('auth');
Route::resource('detalle-compra', App\Http\Controllers\DetalleCompraController::class)->middleware('auth');
Route::resource('productos', App\Http\Controllers\ProductoController::class)->middleware('auth');
Route::resource('tipo-proveedors', App\Http\Controllers\TipoProveedorController::class)->middleware('auth');
Route::resource('insumos', App\Http\Controllers\InsumoController::class)->middleware('auth');
Route::resource('clientes', App\Http\Controllers\ClienteController::class)->middleware('auth');
Route::resource('tipo-clientes', App\Http\Controllers\TipoClienteController::class)->middleware('auth');
Route::resource('ventas', App\Http\Controllers\VentaController::class)->middleware('auth');


});


/*Route::resource('compras', App\Http\Controllers\CompraController::class)->middleware('auth');
Route::resource('detalle_compras', App\Http\Controllers\DetalleCompraController::class)->middleware('auth');


Route::resource('productos', App\Http\Controllers\ProductoController::class)->middleware('auth');
Route::resource('tipo-proveedors', App\Http\Controllers\TipoProveedorController::class)->middleware('auth');
Route::resource('proveedores', App\Http\Controllers\ProveedoreController::class)->middleware('auth');
Route::resource('insumos', App\Http\Controllers\InsumoController::class)->middleware('auth');
Route::resource('clientes', App\Http\Controllers\ClienteController::class)->middleware('auth');
Route::resource('tipo-clientes', App\Http\Controllers\TipoClienteController::class)->middleware('auth');
Route::resource('ventas', App\Http\Controllers\VentaController::class)->middleware('auth');
*/
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');
