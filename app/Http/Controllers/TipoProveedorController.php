<?php

namespace App\Http\Controllers;

use App\Models\Proveedore;
use App\Models\TipoProveedor;
use Illuminate\Http\Request;
use app\Http\Controllers\ProveedoreController;
/**
 * Class TipoProveedorController
 * @package App\Http\Controllers
 */
class TipoProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipoProveedors = TipoProveedor::paginate();

        return view('tipo-proveedor.index', compact('tipoProveedors'))
            ->with('i', (request()->input('page', 1) - 1) * $tipoProveedors->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipoProveedor = new TipoProveedor();
        return view('tipo-proveedor.create', compact('tipoProveedor'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(TipoProveedor::$rules);

        $tipoProveedor = TipoProveedor::create($request->all());

        return redirect()->route('tipo-proveedors.index')
            ->with('success', 'Se ha creado correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tipoProveedor = TipoProveedor::find($id);

        return view('tipo-proveedor.show', compact('tipoProveedor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tipoProveedor = TipoProveedor::find($id);

        return view('tipo-proveedor.edit', compact('tipoProveedor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  TipoProveedor $tipoProveedor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipoProveedor $tipoProveedor)
    {
        request()->validate(TipoProveedor::$rules);

        $tipoProveedor->update($request->all());

        return redirect()->route('tipo-proveedors.index')
            ->with('success', 'Se ha actualizado correctamente.');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
         //validar que no tenga proveedores asociados
         $tipoProveedor=Proveedore::where('id',$id)->get();
            if($tipoProveedor){
                return redirect()->route('tipo-proveedors.index')
                ->with('error', 'No se puede eliminar el tipo de proveedor, tiene proveedores asociados');
            }
        $tipoProveedor = TipoProveedor::find($id)->delete();
        return redirect()->route('tipo-proveedors.index')
            ->with('success', 'Se ha eliminado correctamente');
            
        
    }
}
