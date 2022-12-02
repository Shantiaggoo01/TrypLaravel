<?php

namespace App\Http\Controllers;

use App\Models\DetalleProducto;
use Illuminate\Http\Request;
Use App\Models\Insumo;
Use App\Models\Producto;
/**
 * Class DetalleProductoController
 * @package App\Http\Controllers
 */
class DetalleProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $detalleProductos = DetalleProducto::paginate();
        $insumo = Insumo::all();
        $producto = Producto::all();
        return view('detalle-producto.index', compact('detalleProductos','insumo','producto'))
            ->with('i', (request()->input('page', 1) - 1) * $detalleProductos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $detalleProducto = new DetalleProducto();
        $insumo = Insumo::all();
        $producto = Producto::all();
        return view('detalle-producto.create', compact('detalleProducto','insumo','producto'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(DetalleProducto::$rules);

        $detalleProducto = DetalleProducto::create($request->all());

        return redirect()->route('detalle-productos.index')
            ->with('success', 'DetalleProducto created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detalleProducto = DetalleProducto::find($id);

        return view('detalle-producto.show', compact('detalleProducto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $detalleProducto = DetalleProducto::find($id);

        return view('detalle-producto.edit', compact('detalleProducto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  DetalleProducto $detalleProducto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DetalleProducto $detalleProducto)
    {
        request()->validate(DetalleProducto::$rules);

        $detalleProducto->update($request->all());

        return redirect()->route('detalle-productos.index')
            ->with('success', 'DetalleProducto updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $detalleProducto = DetalleProducto::find($id)->delete();

        return redirect()->route('detalle-productos.index')
            ->with('success', 'DetalleProducto deleted successfully');
    }
}
