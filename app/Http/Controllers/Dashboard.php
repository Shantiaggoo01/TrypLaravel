<?php

namespace App\Http\Controllers;

use App\Models\Produccion;
use Illuminate\Http\Request;
use App\Models\Venta;
use App\Models\Producto;
use Carbon\Carbon;
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
    $produccion = Produccion::all();
    $cproduccion = Produccion::count();
    $ventas = Venta::where('created_at', '>=', Carbon::now()->subDays(7))
                ->groupBy('fecha')
                ->selectRaw('SUM(total) as total, DATE(created_at) as fecha')
                ->get();

                $productos = DB::table('ventas')
                ->join('detalle_ventas', 'ventas.id', '=', 'detalle_ventas.idVenta')
                ->join('productos', 'detalle_ventas.idProducto', '=', 'productos.id')
                ->select('productos.nombre', DB::raw('SUM(detalle_ventas.cantidad) as cantidad'))
                ->groupBy('productos.nombre')
                ->orderBy('cantidad', 'desc')
                ->take(5)
                ->get();


    return view('dashboard', compact('ventas', 'cantidad', 'total', 'productos', 'cproducto', 'produccion', 'cproduccion'));
}

}
