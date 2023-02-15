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
            {{ Form::label('nit') }}
            {{ Form::text('nit', $proveedore->nit, ['class' => 'form-control' . ($errors->has('nit') ? ' is-invalid' : ''), 'placeholder' => 'Nit']) }}
            {!! $errors->first('nit', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('nombre') }}
            {{ Form::text('nombre', $proveedore->nombre, ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
            {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('direccion') }}
            {{ Form::text('direccion', $proveedore->direccion, ['class' => 'form-control' . ($errors->has('direccion') ? ' is-invalid' : ''), 'placeholder' => 'Direccion']) }}
            {!! $errors->first('direccion', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('telefono') }}
            {{ Form::text('telefono', $proveedore->telefono, ['class' => 'form-control' . ($errors->has('telefono') ? ' is-invalid' : ''), 'placeholder' => 'Telefono']) }}
            {!! $errors->first('telefono', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('banco') }}
            {{ Form::text('banco', $proveedore->banco, ['class' => 'form-control' . ($errors->has('banco') ? ' is-invalid' : ''), 'placeholder' => 'Banco']) }}
            {!! $errors->first('banco', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('cuenta') }}
            {{ Form::text('cuenta', $proveedore->cuenta, ['class' => 'form-control' . ($errors->has('cuenta') ? ' is-invalid' : ''), 'placeholder' => 'Cuenta']) }}
            {!! $errors->first('cuenta', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Tipo de proveedor') }}
            {{ Form::select('idtipo_proveedor',$tipo_proveedors, $proveedore->idtipo_proveedor, ['class' => 'form-control' . ($errors->has('idtipo_proveedor') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione un tipo de proveedor']) }}
            {!! $errors->first('idtipo_proveedor', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        @if ($proveedore->estado == 1)
           {{$estado = 'Activo';}} 
        @else
           {{ $estado = 'Inactivo';}}
        @endif

        <div class="form-group"><!-- agregue esto para el estado  -->
            {{ Form::label('Estado') }}
            {{ //campo texto solo de lectura
            Form::text('estado', $estado, ['class' => 'form-control' . ($errors->has('estado') ? ' is-invalid' : ''), 'placeholder' => 'Estado', 'readonly' => 'readonly']) }}
            {!! $errors->first('estado', '<div class="invalid-feedback">:message</div>') !!}
        </div>
  

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>