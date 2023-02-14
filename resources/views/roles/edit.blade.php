@extends('layouts.app2')

@section('template_title')
Crear Usuarios
@endsection
@section('css')
<!-- agregamos para los estilos de la datatable  -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/select/1.5.0/css/select.dataTables.min.css">
@endsection
@section('js')
<!-- agregamos para los estilos de la datatable  -->

<!-- datos anteriores  -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/select/1.5.0/js/dataTables.select.min.js"></script>

<script>
    $(document).ready(function() {
        $('#example').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.13.1/i18n/es-ES.json"
            }
        });

        // Checkbox de selección "todos"
        $('#select-all').click(function() {
            $('input[type="checkbox"]').prop('checked', $(this).prop('checked'));
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
        var respuesta = confirm("¡Confirme para EDITAR y GUARDAR la informacion!");

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
                        <label for="">
                            <h3>Nombre del rol</h3>
                        </label>
                        {!!Form::text('name',null,array('class'=>'form-control'))!!}
                    </div>
                    @error('name')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-12 ">
                    <div class="form-group">

                        <input type="checkbox" id="select-all"> Seleccionar todos
                        <hr>

                        <table id="example" class="table table-striped table-hover">
                            <thead class="thead">
                                <tr>
                                    <th class="col-md-1 "><label>Seleccione</label> </th>
                                    <th> <label for="">Permisos para este Rol:</label></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($permission as $value)
                                <tr>
                                    <td>
                                        <label>
                                            {{Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions))}}
                                        </label>
                                    </td>
                                    <td><label> {{$value->name}}</label></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>

                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary float-right" onclick="return confirmacionGuardar()">Guardar</button>

                    <button onclick="history.back()" type="button" class="btn btn-primary float-left">Cancelar</button>
                </div>
            </div>
            {!!Form::close()!!}


        </div>
    </div>


</section>




@endsection