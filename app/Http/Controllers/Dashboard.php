<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta;
use App\Models\Producto;
use DB;


class Dashboard extends Controller
{
    public function index()
{
    $ventas = Venta::all();
    $cantidad = Venta::count();
    $total = Venta::sum('total');
    $productos = Producto::all();
    $cproducto = Producto::count();
    
    return view('dashboard', compact('ventas', 'cantidad', 'total', 'productos', 'cproducto'));
}

}
