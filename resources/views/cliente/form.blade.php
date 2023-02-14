<div class="box box-info padding-1">


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

    <div class="box-body">
        

    <div class="form-group">
            {{ Form::label('NIT') }}
            {{ Form::text('NIT', $cliente->NIT, ['class' => 'form-control' . ($errors->has('NIT') ? ' is-invalid' : ''), 'placeholder' => 'Nit']) }}
            {!! $errors->first('NIT', '<div class="invalid-feedback"></div>') !!}
            @error('NIT')
             <small class="text-danger">{{ str_replace("n i t","NIT",$errors->first('NIT')) }}</small>
            @enderror
        </div>
        


    


        <div class="form-group">
            {{ Form::label('Tipo Cliente') }}
            {{ Form::select('idTipoCliente', $tipos , $cliente->idTipoCliente, ['class' => 'form-control' . ($errors->has('idTipoCliente') ? ' is-invalid' : ''), 'placeholder' => 'Tipo Cliente']) }}
            {!! $errors->first('idTipoCliente', '<div class="invalid-feedback"></div>') !!}
            @error('idTipoCliente')
                <small class="text-danger">{{ str_replace("id tipo cliente","Tipo de Cliente",$errors->first('idTipoCliente')) }}</small>
            @enderror
        </div>
        <div class="form-group">
            {{ Form::label('Nombre') }}
            {{ Form::text('Nombre', $cliente->Nombre, ['class' => 'form-control' . ($errors->has('Nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
            {!! $errors->first('Nombre', '<div class="invalid-feedback"></div>') !!}
            @error('Nombre')
                <small class="text-danger">{{ str_replace("nombre","Nombre",$errors->first('Nombre')) }}</small>
            @enderror
        </div>
        <div class="form-group">
            {{ Form::label('Apellido') }}
            {{ Form::text('Apellido', $cliente->Apellido, ['class' => 'form-control' . ($errors->has('Apellido') ? ' is-invalid' : ''), 'placeholder' => 'Apellido']) }}
            {!! $errors->first('Apellido', '<div class="invalid-feedback"></div>') !!}
            @error('Apellido')
                <small class="text-danger">{{ str_replace("apellido","Apellido",$errors->first('Apellido')) }}</small>
            @enderror
        </div>
        <div class="form-group">
            {{ Form::label('Telefono') }}
            {{ Form::text('Telefono', $cliente->Telefono, ['class' => 'form-control' . ($errors->has('Telefono') ? ' is-invalid' : ''), 'placeholder' => 'Telefono']) }}
            {!! $errors->first('Telefono', '<div class="invalid-feedback"></div>') !!}
            @error('Telefono')
                <small class="text-danger">{{ str_replace("telefono","Telefono",$errors->first('Telefono')) }}</small>
            @enderror
        </div>
        <div class="form-group">
            {{ Form::label('Direccion') }}
            {{ Form::text('Direccion', $cliente->Direccion, ['class' => 'form-control' . ($errors->has('Direccion') ? ' is-invalid' : ''), 'placeholder' => 'Direccion']) }}
            {!! $errors->first('Direccion', '<div class="invalid-feedback"></div>') !!}
            @error('Direccion')
                <small class="text-danger">{{ str_replace("direccion","Direccion",$errors->first('Direccion')) }}</small>
            @enderror
        </div>
       
       

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>
</div>