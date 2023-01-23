@extends('layouts.app2')
@section('js')
<script>
    //confirmacion de Guardar 
    function confirmacionGuardar() {
        var respuesta = confirm("¡Confirme para GUARDAR la informacion!");

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
            <span class="card-title">Registrar Usuario</span>
        </div>
        <div class="card-body">

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


            {!!Form::open(array('route'=>'usuarios.store','method'=>'POST'))!!}
            <div class="row">
                <div class="col-md-12">

                    <div class="form-group">
                        <label for="">Documento</label>
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
                        <label for="password"> Contraseña </label>
                        {!!Form::password('password',array('class'=>'form-control'))!!}
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="confirm-password"> Confirmar contraseña </label>
                        {!!Form::password('confirm-password',array('class'=>'form-control'))!!}
                    </div>
                </div>


            </div>

            <br>

            <div class="col-md-12">

                <button type="submit" class="btn btn-primary float-left" onclick= "return confirmacionGuardar()">Registrar Usuario</button>
                
                <button onclick="history.back()" type="button" class="btn btn-primary float-right">Cancelar</button>


            </div>
        </div>

        {!!Form::close()!!}


    </div>

</section>




@endsection