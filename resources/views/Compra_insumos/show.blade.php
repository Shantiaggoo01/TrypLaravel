@extends('layouts.app2')

@section('template_title')
Compra_insumos
@endsection
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
@endsection
@section('js')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@if ($message = Session::get('success') )
<script>
    swal({
        title: "{{session::get('success')}}",
        icon: "success",
        button: "Aceptar",
    });
</script>
@endif
@endsection

@section('content')


@if(count($insumos) > 0)
<!-- 
 
detalle de el proveedor

<div class="row">
    <div class="row">
        <h1 colspan="4" class="text-center"><I>DETALLE DE LA COMPRA</I></h1>
        <hr>
        @forelse ($compras as $value)
        <tr>
            <div class="col-5">
                <h4><I>NUMERO FACTURA: {{$value->nFactura}}</I></h4>
            </div>
            <div class="col-5">
                <h4><I>TOTAL COMPRA: {{$value->Total}}</I></h4>
            </div>
        </tr>
        @empty
        @endforelse
    </div>

</div> -->

<div class="card-body">
    <div class="table-responsive">
        <div class="col">
            <h2 colspan="4" class="text-center">INSUMOS COMPRADOS</h2>
            <hr>
            <table id="example" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Nombre Insumo </th>
                        <th>Cantidad Compradas </th>
                        <th>Precio unitario</th>
                        <th>Sub Total </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($insumos as $value)
                    <tr>
                        <th>{{$value->Nombre}}</th>
                        <th>{{$value->cantidad}}</th>
                        <th>{{$value->Precio}}</th>
                        <th>{{$value->Precio * $value->cantidad}}</th>
                    </tr>
                    @empty no hay Insumos Regustrados
                    @endforelse
                </tbody>
            </table>
            
        </div>
        <br>
        <button onclick="history.back()" type="button" class="btn btn-primary col">Volver</button>

        @endif
    </div>
</div>


@endsection