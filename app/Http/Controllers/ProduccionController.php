<?php

namespace App\Http\Controllers;

use App\Models\Produccion;
use App\Models\Producto;
use Illuminate\Http\Request;
use DB;
use App\Models\Detalle_produccion;

/**
 * Class ProduccionController
 * @package App\Http\Controllers
 */
class ProduccionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produccions = Produccion::paginate();

        return view('produccion.index', compact('produccions'))
            ->with('i', (request()->input('page', 1) - 1) * $produccions->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $produccion = new Produccion();
        $productos = Producto::all();
        return view('produccion.create', compact('produccion', 'productos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input=$request->all();
        try{
            DB::beginTransaction();
            $produccion = Produccion::create([
                'fecha_produccion' => $input['FechaP'],
                'fecha_vencimiento' => $input['FechaV'],
                'cantidad' => $input['cantidad'],
            ]);
           //foreach para guardar los productos de la produccion 
            foreach ($input['producto'] as $key => $value) {
               $detalle_produccion = Detalle_produccion::create([
                    'id_produccion' => $produccion->id,
                    'id_producto' => $value,
                    'cantidad' => $input['cantidad'][$key],
                ]);
                $ins=Producto::find($value);
                $ins->Stock=$ins->Stock+$input['cantidad'][$key];
            }

            DB::commit();
            return redirect()->route('produccion.index')
                ->with('success', 'Produccion creada con exito.');
        }catch(\Exception $e){
            DB::rollback();
            return redirect()->route('produccion.index')
                ->with('error', 'Error al crear la produccion.');
        }

    }

    
            
    
            
            
    public function Calcular_precio($insumos, $cantidades)
    {

        $Total = 0;

        foreach ($insumos as $key => $value) {
        
            $producto = Producto::find($value);
            //capturo el valor del input cantidad
            $cantidad=

            $Total += ($producto->Precio * $cantidades[$key]);
        }

        return $Total;
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $produccion = Produccion::find($id);

        return view('produccion.show', compact('produccion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $produccion = Produccion::find($id);

        return view('produccion.edit', compact('produccion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Produccion $produccion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produccion $produccion)
    {
        request()->validate(Produccion::$rules);

        $produccion->update($request->all());

        return redirect()->route('produccions.index')
            ->with('success', 'Produccion updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $produccion = Produccion::find($id)->delete();

        return redirect()->route('produccions.index')
            ->with('success', 'Produccion deleted successfully');
    }
}
