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

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">

                    <div>
                        @if(session('status'))
                        @if (session('status') == '1')
                        <div class="alert alert-success">
                            se guardo correctamente
                        </div>
                        @else
                        <div class="alert alert-danger">
                            {{session('status')}}
                        </div>
                        @endif
                        @endif

                    </div>
                    <div style="display: flex; justify-content: space-between; align-items: center;">

                        <span id="card_title">
                            {{ __('Compra') }}
                        </span>

                        <div class="float-right">
                            <a href="{{ route('compra_insumos.create') }}" class="btn btn-primary btn-sm float-right" data-placement="left">
                                {{ __('Nueva Compra') }}
                            </a>
                        </div>
                    </div>
                </div>
                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
                @endif

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-hover">
                            <thead class="thead">
                                <tr>

                                    <th>#Factura</th>
                                    <th>Proveedor</th>
                                    <th>insumos</th>
                                    <th>Fecha de compra </th>
                                    <th>$Total Compra</th>

                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($compras as $comp)
                                <tr>

                                    <td>{{ $comp->nFactura }}</td>
                                    <td>{{ $comp->nombreProveedor }}</td>
                                    <td>{{ $comp->id_insumo }}</td>
                                    <td>{{ $comp->FechaCompra }}</td>
                                    <td>{{ $comp->Total }}</td>

                                    <td>

                                    </td>



                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection