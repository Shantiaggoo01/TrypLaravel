@extends('layouts.app2')

@section('template_title')
Crear Usuarios
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
        $('#example').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.13.1/i18n/es-ES.json"
            }
        });
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

<script>
    //confirmacion de Guardar 
    function confirmacionGuardar() {
        var respuesta = confirm("¡Confirme para EDITAR la informacion!");

        if (respuesta == true) {
            return true;
        } else {
            return false;
        }

        //'onclick'=>'return confirmacionGuardar()'
        //onclick= "return confirmacionGuardar()"
    }
</script>

@endsection
@section('content')

<section class="content container-fluid">

    @includeif('partials.errors')

    <div class="card card-default">
        <div class="card-header">
            <span class="card-title">Editar Rol</span>
        </div>
        <div class="card-body">

            {!!Form::model($role,['method'=>'PATCH','route'=>['roles.update',$role->id]])!!}
            <div class="row">
                <div class="col-md-12">

                    <div class="form-group">
                        <label for="">Nombre del rol</label>
                        {!!Form::text('name',null,array('class'=>'form-control'))!!}
                    </div>
                </div>
                <div class="col-md-12 ">
                    <div class="form-group">

                        <table id="example" class="table table-striped table-hover">
                            <thead class="thead">
                                <tr>
                                    <th> -- Seleccione -- </th>
                                    <th> <label for="">Permisos para este Rol:</label></th>
                                </tr>
                            </thead>
                            <tbody>
                                <label for="">Permisos para este Rol:</label>
                                <br>
                                @foreach($permission as $value)
                                <tr>
                                    <td> <label>{{Form::checkbox('permission[]',$value->id,in_array($value->id,$rolePermissions))}}{{$value->name}}</label> </td>
                                    <td><label> {{$value->name}}</label></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>

                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary float-left" onclick="return confirmacionGuardar()">Guardar</button>

                    <button onclick="history.back()" type="button" class="btn btn-primary float-right">Cancelar</button>
                </div>
            </div>
            {!!Form::close()!!}


        </div>
    </div>


</section>




@endsection