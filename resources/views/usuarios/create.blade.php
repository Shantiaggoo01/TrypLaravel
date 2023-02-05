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


<script>
    const input = document.getElementById("image");
    const preview = document.getElementById("preview");

    input.addEventListener("change", function() {
        const file = this.files[0];
        const reader = new FileReader();

        reader.addEventListener("load", function() {
            preview.src = reader.result;
        });

        reader.readAsDataURL(file);
    });
</script>

<style>
    #preview {
        width: 200px;
        height: 200px;
        object-fit: cover;
        border: 2px solid #333;

        margin-left: 10px;
    }
</style>

<style>
    .center-label {
        text-align: center;
        display: block;
    }
</style>

@endsection

@section('content')

<section class="content container-fluid">

    @includeif('partials.errors')

    <div class="card card-default">
        <div class="card-header">
            <span class="card-title ">Registrar Usuario</span>
        </div>
        <div class="card-body">



            {!! Form::open(['route' => ['usuarios.store'], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="image" class="center-label">Imagen de perfil</label>
                        <img id="preview" style="width: 200px; display: block; margin: 0 auto;">
                        <br>

                        <input type="file" name="image" id="image" class="form-control">
                        @error('image')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <br>

                    </div>
                </div>

                <hr>

                <div class="col-md-12">

                    <div class="form-group">
                        <label for="">Documento</label>
                        {!!Form::text('documento',old('documento'),array('class'=>'form-control'))!!}
                        @error('documento')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="name">Nombre</label>
                        {!!Form::text('name',old('name'),array('class'=>'form-control'))!!}
                        @error('name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="apellido">Apellidos</label>
                        {!!Form::text('apellido',old('apellido'),array('class'=>'form-control'))!!}
                        @error('apellido')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="telefono">Telefono</label>
                        {!!Form::text('telefono',old('telefono'),array('class'=>'form-control'))!!}
                        @error('telefono')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="direccion">Direccion</label>
                        {!!Form::text('direccion',old('direccion'),array('class'=>'form-control'))!!}
                        @error('direccion')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form group">
                        <label for="email">E-mail</label>
                        {!!Form::text('email',old('email'),array('class'=>'form-control'))!!}
                        @error('email')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="password"> Contraseña </label>
                        {!!Form::password('password',array('class'=>'form-control'))!!}
                        @error('password')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="confirm-password"> Confirmar contraseña </label>
                        {!!Form::password('confirm-password',array('class'=>'form-control'))!!}
                        @error('confirm-password')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

            </div>

            <br>

            <div class="col-md-12">

                <button type="submit" class="btn btn-primary float-left" onclick="return confirmacionGuardar()">Registrar Usuario</button>

                <button onclick="history.back()" type="button" class="btn btn-primary float-right">Cancelar</button>


            </div>
        </div>

        {!!Form::close()!!}

</section>




@endsection