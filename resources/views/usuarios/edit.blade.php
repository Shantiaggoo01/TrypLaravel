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
@endsection
@section('content')

<section class="content container-fluid">

    @includeif('partials.errors')

    <div class="card card-default">
        <div class="card-header">
            <span class="card-title"> Editar Usuario</span>
        </div>
        <div class="card-body">


            {!!Form::model($user,['method'=>'PATCH','route'=>['usuarios.update',$user->id]] )!!}
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
                        <label for="apellido">Apellidos</label>
                        {!!Form::text('apellido',null,array('class'=>'form-control'))!!}
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="telefono">Telefono</label>
                        {!!Form::text('telefono',null,array('class'=>'form-control'))!!}
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="direccion">Direccion</label>
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
                        <label for=""> Rol del Usuario </label>
                        {!!Form::select('roles[]',$roles,[],array('class'=>'form-control','placeholder' => '---Seleccione Nuevo Rol ---'))!!}
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
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>



            </div>

            {!!Form::close()!!}


        </div>
    </div>
    </div>



    </div>
    </div>
    </div>
    </div>
</section>




@endsection