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
    $(document).ready(function() {
        // Agrega el Sweet Alert cuando se envía el formulario
        $('#form-usuario').on('submit', function(event) {
            event.preventDefault();
            swal({
                    title: "¿Estás seguro?",
                    text: "¿Seguro que desea editar este usuario ?",
                    icon: "warning",
                    buttons: ["Cancelar", "Guardar"],
                    dangerMode: true,
                })
                .then((willAdd) => {
                    if (willAdd) {
                        // Envía el formulario
                        this.submit();
                    } else {
                        swal("El usuario no se ha editado.", {
                            icon: "info",
                        });
                    }
                });
        });
    });
</script>

@endsection
@section('content')

<section class="content container-fluid">

    @includeif('partials.errors')




    @if($errors->any())
    <div class="alert alert-dark alert-dismissible fade show" role="alert">
        <strong>¡Revise los campos !</strong>
        @foreach($errors->all() as $error)
        <span class="badge badge-danger">{{$error}}</span>
        @endforeach
        <button type="button" class="close" data-dismiss="alert" aria-label="close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif


    {!! Form::model($user, ['method' => 'PATCH', 'route' => ['usuarios.update', $user->id], 'enctype' => 'multipart/form-data', 'id' => 'form-usuario']) !!}


    <div class="card card-default">

        <div class="card card-default">

            <div class="card-header text-center">
                <span class="card-title">
                    <label>
                        <h4>Asignar rol al usuario: <i style="color:RED">{{$user->name}} {{$user->apellido}}&nbsp;&nbsp;&nbsp;
                            </i>Rol actual : @if(!empty($user->getRoleNames()))
                            <strong style="color:red">
                                @foreach($user->getRoleNames() as $rolName)
                                {{$rolName}}
                                @endforeach
                            </strong>
                            @else
                            <em>No hay roles asignados</em>
                            @endif</i>
                        </h4>
                </span>
            </div>


            <br>

            <div class="col-md-12">
                <div class="form-group">
                    <label for=""> Rol del usuario</label>
                    <?php
                    // establece el valor seleccionado en el menú desplegable como el rol actual del usuario
                    $selectedRole = !empty($selectedRoles) ? $selectedRoles[0] : null;
                    $roles = array_merge(['' => '--- Ninguno ---'], $roles);
                    ?>
                    {!! Form::select('roles[]', $roles, $selectedRole, ['class' => 'form-control']) !!}
                </div>
            </div>

        </div>
        <br>
        <hr>
        <br>

        <div class="card-header">
            <div class="card-header text-center">
                <img class="rounded-circle mb-3 mt-4" src="{{asset('images/' . $user->image) }}" alt="{{ $user->name }}" width="180" height="160">
                <div class="form-group">
                    <img id="preview" style="width: 200px;">
                    <input type="file" name="image" id="image" class="form-control">
                    @error('image')
                    <div class="text-danger">{{ str_replace("image", "Imagen", $errors->first('image')) }}</div>
                    @enderror
                    <br>
                </div>
                <span class="card-title">
                    <h3>Informacion del usuario : <i style="color:RED">{{$user->name}} {{$user->apellido}}</i></h3>
                </span>
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="documento">Documento</label>
                            {!!Form::text('documento',null,array('class'=>'form-control'))!!}
                        </div>

                        <div class="form-group">
                            <label for="name">Nombre</label>
                            {!!Form::text('name',null,array('class'=>'form-control'))!!}
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="apellido">Apellido</label>
                            {!!Form::text('apellido',null,array('class'=>'form-control'))!!}
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="telefono">Teléfono</label>
                            {!!Form::text('telefono',null,array('class'=>'form-control'))!!}
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="direccion">Dirección</label>
                            {!!Form::text('direccion',null,array('class'=>'form-control'))!!}
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form group">
                            <label for="email">E-mail</label>
                            {!!Form::text('email',null,array('class'=>'form-control'))!!}
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="password"> Cambiar Contraseña </label>
                            {!!Form::password('password',array('class'=>'form-control'))!!}
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="confirm-password"> Confirmar contraseña </label>
                            {!!Form::password('confirm-password',array('class'=>'form-control'))!!}
                        </div>
                    </div>

                    <div class="col-md-12">

                        <button onclick="history.back()" type="button" class="btn btn-primary float-left">Cancelar</button>
                        <button type="submit" class="btn btn-primary float-right" onclick="return confirmacionGuardar();" history.back()">Editar</button>
                    </div>



                </div>

                {!!Form::close()!!}


            </div>
        </div>

</section>




@endsection