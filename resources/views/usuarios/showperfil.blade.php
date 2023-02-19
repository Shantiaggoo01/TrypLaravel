@extends('layouts.app2')

@section('template_title')
Usuario
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


<!-- Body -->
<div class="container position-relative">
    <div class="row d-flex justify-content-center">
        <div class="col-md-8 col-lg-6 col-xl-5 col-xxl-12">
            <div class="card mb-5">


                <div class="card-body text-center shadow"><img class="rounded-circle mb-3 mt-4" src="{{ asset('images/' . Auth::user()->image) }}" alt="{{ Auth::user()->name }}" width="180" height="160">

                    <h3 class="title mt-3"><b> {{ Auth::user()->name}} {{ Auth::user()->apellido }}</b></h3>
                    <hr>
                    <div class="mb-3">
                        <i class="title mt-3"><b>Documento&nbsp;:&nbsp;</b> </i> {{ Auth::user()->documento}}<br>
                        <i class="title mt-3"><b>Teléfono&nbsp;:&nbsp;</b></i>{{ Auth::user()->telefono }}<br>
                        <i class="title mt-3"><b>Rol&nbsp;:&nbsp;</b></i> @if(!empty(Auth::user()->getRoleNames()))
                        <i style="color:red"> @foreach($user->getRoleNames() as $rolName)
                            {{$rolName}}
                            @endforeach
                            @endif
                        </i>
                        <br>
                        <i class="title mt-3"><b>Correo electrónico</b>&nbsp;:&nbsp;</i> {{ Auth::user()->email }}</i><br>

                        <h6 class="title mt-3"><b>Fecha de creación&nbsp;:&nbsp; {{ Auth::user()->created_at }}</b></h6>
                    </div>





                </div>

                <br>
                <hr>


                {!! Form::model( Auth::user(), ['method' => 'PATCH', 'route' => ['usuarios.update', Auth::user()->id], 'enctype' => 'multipart/form-data']) !!}


                <div class="card card-default">
                    <div class="card-header">
                        <div class="card-header text-center">
                            <div class="form-group">
                                <img id="preview" style="width: 200px;">
                                <input type="file" name="image" id="image" class="form-control">
                                @error('documento')
                                <div class="text-danger">{{ str_replace("documento", "Contraseña", $errors->first('password')) }}</div>
                                @enderror
                                <br>
                            </div>
                            <span class="card-title">
                                <h3>Informacion del Usuario : <i style="color:RED">{{ Auth::user()->name}} {{ Auth::user()->apellido}}</i></h3>
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

                                    <button onclick="history.back()" type="button" class="btn btn-primary float-left">Atrás</button>

                                    <button type="submit" class="btn btn-primary float-right" onclick="return confirmacionGuardar();" history.back()">Editar</button>
                                </div>



                            </div>

                            {!!Form::close()!!}

                        </div>
                    </div>
                </div>
            </div>

            @endsection