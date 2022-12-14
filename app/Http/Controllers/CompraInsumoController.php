<?php

namespace App\Http\Controllers;

use App\Models\CompraInsumo;
use Illuminate\Http\Request;
use App\Models\Compra;
use App\Models\Insumo;
use App\Models\Proveedore;
use DB;
use Exception;

/**
 * Class CompraInsumoController
 * @package App\Http\Controllers
 */
class CompraInsumoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $compraInsumos = CompraInsumo::paginate();

        //$compras = Compra::all();

        $compras = Compra::select("compras.*","proveedores.nombre as nombreProveedor")
        ->join("proveedores","proveedores.id","=","compras.id_proveedor")
        ->get();
        

        $insumos = Insumo::all();
        $proveedores = Proveedore::all();
        return view('compra_insumos.index', compact('compraInsumos', 'compras', 'insumos', 'proveedores'))
            ->with('i', (request()->input('page', 1) - 1) * $compraInsumos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $compraInsumo = new CompraInsumo();
        $compras = Compra::all();
        $insumos = Insumo::all();
        $proveedores = Proveedore::all();
        return view('compra_insumos.create', compact('compraInsumo', 'compras', 'insumos', 'proveedores'));
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
            $compra = Compra::create([
                "nFactura" => $input["nFactura"],
                "id_proveedor" => $input["id_proveedor"],
                "id_insumo" => $input["id_insumos"],
                "FechaCompra" => $input["FechaCompra"],
                "Total" => $this->calcular_precio($input["id_insumo"], $input["cantidades"])

            ]);

            foreach($input["id_insumo"] as $key => $value){
                CompraInsumo::create([
                    "id_insumo"=>$value,
                   /* "id_proveedor"=>$input["proveedor"][$key],*/
                    "id_compra"=>$compra->id,
                    "cantidad" => $input["cantidades"][$key],
                ]);

               $ins = Insumo::find($value);
               $ins-> update(["cantidad"=>$ins->cantidad - $input["cantidades"][$key]]);

            }
            


            DB::commit();
            return redirect("compra_insumos")->with('status','1');
            

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
    public function show(Request $request)
    {


        $id = $request->input("id");
        $insumos=[];
        if($id != null){
            $insumos = Insumo::select("insumos.*","compra_insumos.cantidad")
            ->join("compra_insumos","insumos.id","=","compra_insumos.id_insumo")
            ->where("compra_insumos.id_compra", $id)
            ->get();
        }
        $compras=[];
        if($id != null){
        $compras = Compra::select("compras.*")
        ->join("compra_insumos","compras.id","=","compra_insumos.id_compra")
        ->where("compra_insumos.id_compra", $id)
        ->get();
        }

        return view("compra_insumos.show", compact("insumos","compras"));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $compraInsumo = CompraInsumo::find($id);

        return view('compra_insumos.edit', compact('compraInsumo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  CompraInsumo $compraInsumo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CompraInsumo $compraInsumo)
    {
        request()->validate(CompraInsumo::$rules);

        $compraInsumo->update($request->all());

        return redirect()->route('compra_insumos.index')
            ->with('success', 'CompraInsumo updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $compraInsumo = CompraInsumo::find($id)->delete();

        return redirect()->route('compra_insumos.index')
            ->with('success', 'CompraInsumo deleted successfully');
    }
}
