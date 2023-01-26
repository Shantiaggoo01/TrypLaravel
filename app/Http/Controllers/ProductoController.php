<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use App\Models\Insumo;
use DB;
use App\Models\producto_insumo;


/**
 * Class ProductoController
 * @package App\Http\Controllers
 */
class ProductoController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:ver-producto|crear-producto|editar-producto|borrar-producto')->only('index');
        $this->middleware('permission:crear-producto' , ['only' => ['create','store']]);
        $this->middleware('permission:editar-producto' , ['only' => ['edit','update']]);
        $this->middleware('permission:borrar-producto' , ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos = Producto::paginate();

        return view('producto.index', compact('productos'))
            ->with('i', (request()->input('page', 1) - 1) * $productos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $producto = new Producto();

        $insumos = Insumo::all();

        return view('producto.create', compact('producto', 'insumos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        try {
            DB::beginTransaction();
            $producto = Producto::create([
                "nombre" => $input["nombre"],
                "tamaño" => $input["tamaño"],
                "sabor" => $input["sabor"],
                "invima" => $input["invima"],
                "peso" => $input["peso"],
                "cantidad" => $input["cantidad"],
                "precio" => $input["precio"],
                //"Total" => $this->calcular_precio($input["id_insumo"], $input["cantidades"])

            ]);

            foreach($input["id_insumo"] as $key => $value){
                $producto_insumo = producto_insumo::create([
                    "id_insumo"=>$value,
                   /* "id_proveedor"=>$input["proveedor"][$key],*/
                    "id_producto"=>$producto->id,
                    "cantidad" => $input["cantidades"][$key],
                ]);

               $ins = Insumo::find($value);
               $ins-> update(["cantidad"=>$ins->cantidad - $input["cantidades"][$key]]);

            }
            


            DB::commit();
            return redirect("compra_insumos")->with('success', 'Producto creado con exito');
            

        } catch (Exception $e) {
            DB::rollback();

            return redirect("compra_insumos")->with('status',$e->getMessage());
        }

    }
    public function Calcular_precio($insumos, $cantidades)
    {

        $Total = 0;

        foreach ($insumos as $key => $value) {
        
            $insumo = Insumo::find($value);
            //capturo el valor del input cantidad
            $cantidad=

            $Total += ($insumo->Precio * $cantidades[$key]);
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
        //mostrar los insumos que tiene el producto seleccionado
        $producto = Producto::find($id);
        $insumos = DB::table('producto_insumo')
            ->join('insumos', 'producto_insumo.id_insumo', '=', 'insumos.id')
            ->select('insumos.*', 'producto_insumo.cantidad')
            ->where('producto_insumo.id_producto', '=', $id)
            ->get();


        return view('producto.show', compact('producto', 'insumos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($idproducto)
    {
        $producto = Producto::find($idproducto);

        return view('producto.edit', compact('producto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Producto $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Producto $producto)
    {
        request()->validate(Producto::$rules);

        $producto->update($request->all());

        return redirect()->route('productos.index')
            ->with('success', 'Producto actualizado correctamente');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $producto_insumo = producto_insumo::find($id)->delete();

        return redirect()->route('productos.index')
            ->with('success', 'Producto eliminado correctamente');
            
    }
}
