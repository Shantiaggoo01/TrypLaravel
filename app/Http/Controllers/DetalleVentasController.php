<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Cliente;
use App\Models\Venta;
use App\Models\detalle_ventas;
use App\Models\Producto;
use DB;
use PDF;

class DetalleVentasController extends Controller
{
    public function index(Request $request)
    {
        $ventas = Venta::select("ventas.*", "clientes.nombre as cliente")
        ->join("clientes", "clientes.id", "=", "ventas.idCliente")
        ->get();



        return view("detalle_ventas.index", compact("ventas"));
    }

    public function create()
    {
        $detalle_ventas = detalle_ventas::paginate();
        $ventas = Venta::all();
        $clientes = Cliente::all();
        $productos = Producto::all();


        return view('detalle_ventas.create', compact('detalle_ventas','ventas','clientes', 'productos'))
            ->with('i', (request()->input('page', 1) - 1) * $detalle_ventas->perPage());
    }

    public function show($id){
        $venta = Venta::find($id);
        

       $ventas=[];
        if($venta !=null){
            $ventas = Venta::select("ventas.*", "clientes.nombre as cliente")
            ->join("clientes", "clientes.id", "=", "ventas.idCliente")
            ->where("ventas.id", $id)
            ->get();
        } 

       

        $productos = [];
        if($venta !=null){
            $productos = Producto::select("productos.*", "detalle_ventas.cantidad as cantidad_c")
            ->join("detalle_ventas", "productos.id", "=", "detalle_ventas.id")
            ->where("detalle_ventas.idVenta", $id )
            ->get();
        }
        $pdf = PDF::loadView('detalle_ventas.show',['productos'=>$productos, 'venta'=>$venta, 'ventas'=>$ventas]);
        return $pdf->stream();
        //return view('detalle_ventas.show', compact('venta', 'productos'));
    }

    public function store(Request $request){
        $input = $request->all();
        try{
            DB::beginTransaction();
            $ventas = Venta::create([
                "idCliente"=>$input["Cliente"],
                "FechaVenta"=>$input["FechaVenta"],
                "Total"=>$this->calcular_precio($input["producto_id"], $input["cantidades"]),
            ]);

            foreach($input["producto_id"] as $key => $value){
                detalle_ventas::create([
                    "idProducto"=>$value,
                    "idVenta"=>$ventas->id,
                    "Cantidad"=>$input["cantidades"][$key]

                ]);

                $product = Producto::find($value);
                $product->update(["cantidad"=>$product->cantidad - $input["cantidades"][$key] ]);
            }



            DB::commit();
            return redirect("/detalle_ventas")->With('status', '1');
        }catch(\Exeption $e){
            DB::rollBack();
            return redirect("/detalle_ventas")->With('status', $e->getMessage());

        }




    }

    public function calcular_precio($producto, $cantidades){
        $precio=0;
        foreach($producto as $key => $value){
            $producto = Producto::find($value);
            $precio += ($producto->precio * $cantidades[$key]);
        }
        return $precio;
    }

}