@extends('layouts.app2')

@section('template_title')
    {{ $producto->name ?? 'Show Producto' }}
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

<div class="card-body">
    <div class="table-responsive">
        <div class="col">
            <h2 colspan="4" class="text-center">Detalle Producto</h2>
            <hr>
            <table id="example" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Nombre Producto </th>
                        <th>Nombre Insumo</th>
                        <th>Cantidad</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($insumos as $value)
                    <tr>
                        <th>{{$producto->nombre}}</th>
                        <th>{{$value->Nombre}}></th>
                        <th>{{$value->cantidad}}</th>
                    </tr>
                @empty no hay Insumos Registrados
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