<?php

namespace App\Http\Controllers;

use App\Models\DetalleCompra;
use Illuminate\Http\Request;

/**
 * Class DetalleCompraController
 * @package App\Http\Controllers
 */
class DetalleCompraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $detalleCompras = DetalleCompra::paginate();

        return view('detalle-compra.index', compact('detalleCompras'))
            ->with('i', (request()->input('page', 1) - 1) * $detalleCompras->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $detalleCompra = new DetalleCompra();
        return view('detalle-compra.create', compact('detalleCompra'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(DetalleCompra::$rules);

        $detalleCompra = DetalleCompra::create($request->all());

        return redirect()->route('detalle-compras.index')
            ->with('success', 'DetalleCompra created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detalleCompra = DetalleCompra::find($id);

        return view('detalle-compra.show', compact('detalleCompra'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $detalleCompra = DetalleCompra::find($id);

        return view('detalle-compra.edit', compact('detalleCompra'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  DetalleCompra $detalleCompra
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DetalleCompra $detalleCompra)
    {
        request()->validate(DetalleCompra::$rules);

        $detalleCompra->update($request->all());

        return redirect()->route('detalle-compras.index')
            ->with('success', 'DetalleCompra updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $detalleCompra = DetalleCompra::find($id)->delete();

        return redirect()->route('detalle-compras.index')
            ->with('success', 'DetalleCompra deleted successfully');
    }
}
