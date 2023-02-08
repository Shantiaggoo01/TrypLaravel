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
        //seleccionar y contar los registros de la tabla ventas
        $cantidad = DB::table('ventas')->count();
        $total = 0;
        //consulta para obtener el total de ventas
        $total = DB::table('ventas')->sum('total');
        $productos=  Producto::all();
        $cproducto= DB::table('productos')->count();
        return view('dashboard')->with('ventas', $ventas)->with('cantidad', $cantidad)->with('total', $total)->with('productos', $productos)->with('cproducto', $cproducto);
    }
}
