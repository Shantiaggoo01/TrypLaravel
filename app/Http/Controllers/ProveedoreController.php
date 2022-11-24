<?php

namespace App\Http\Controllers;

use App\Models\Proveedore;
use App\Models\TipoProveedor;
use Illuminate\Http\Request;

//Agregamos 

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\support\Facades\DB;

/**
 * Class ProveedoreController
 * @package App\Http\Controllers
 */
class ProveedoreController extends Controller
{

    // si habilito esta funcion se supone que debe de dar permisos ---
    function __construct()
    {
        $this->middleware('permission:ver-proveedor|crear-proveedor|editar-proveedor|borrar-proveedor')->only('index');
        $this->middleware('permission: crear-proveedor' , ['only' => ['create','store']]);
        $this->middleware('permission: editar-proveedor' , ['only' => ['edit','update']]);
        $this->middleware('permission: borrar-proveedor' , ['only' => ['destroy']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proveedores = Proveedore::paginate();
        $tipo_proveedors = TipoProveedor::pluck('nombre', 'id');
        return view('proveedore.index', compact('proveedores', 'tipo_proveedors'))
            ->with('i', (request()->input('page', 1) - 1) * $proveedores->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $proveedore = new Proveedore();
        $tipo_proveedors = TipoProveedor::pluck('nombre', 'id');
        return view('proveedore.create', compact('proveedore', 'tipo_proveedors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Proveedore::$rules);

        $proveedore = Proveedore::create($request->all());

        return redirect()->route('proveedores.index')
            ->with('success', 'Proveedor creado correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $proveedore = Proveedore::find($id);

        return view('proveedore.show', compact('proveedore'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tipo_proveedors = TipoProveedor::pluck('nombre', 'id');
        $proveedore = Proveedore::find($id);
        return view('proveedore.edit', compact('proveedore', 'tipo_proveedors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Proveedore $proveedore
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Proveedore $proveedore)
    {
        request()->validate(Proveedore::$rules);

        $proveedore->update($request->all());

        return redirect()->route('proveedores.index')
            ->with('success', 'Proveedor actualizado correctamente.');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $proveedore = Proveedore::find($id)->delete();

        return redirect()->route('proveedores.index')
            ->with('success', 'Proveedor eliminado correctamente.');
    }
}
