<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Cliente;
use App\Models\Producciones;
use App\Models\detalle_ventas;
use Illuminate\Http\Request;
use App\Models\Producto;
use DB;

/**
 * Class VentaController
 * @package App\Http\Controllers
 */
class VentaController extends Controller
{

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ventas = Venta::paginate();
        $detalle_ventas = detalle_ventas::all();
        $produccion = Producciones::all();
        $productos = Producto::all();

        return view('venta.index', compact('ventas','produccion','detalle_ventas','productos'))
            ->with('i', (request()->input('page', 1) - 1) * $ventas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $venta = new Venta();
        $clientes = Cliente::pluck('Nombre','id');
        $detalle_ventas = detalle_ventas::all();
        $produccion = Producciones::all();
        $productos = Producto::all();

        return view('venta.create', compact('venta','clientes','produccion','detalle_ventas','productos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Venta::$rules);

        $venta = Venta::create($request->all());

        return redirect()->route('ventas.index')
            ->with('success', 'Venta created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $venta = Venta::find($id);

        return view('venta.show', compact('venta'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $venta = Venta::find($id);
        $clientes = Cliente::pluck('Nombre','id');

        return view('venta.edit', compact('venta','clientes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Venta $venta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Venta $venta)
    {
        request()->validate(Venta::$rules);

        $venta->update($request->all());

        return redirect()->route('ventas.index')
            ->with('success', 'Venta updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $venta = Venta::find($id)->delete();

        return redirect()->route('ventas.index')
            ->with('success', 'Venta deleted successfully');
    }
}
