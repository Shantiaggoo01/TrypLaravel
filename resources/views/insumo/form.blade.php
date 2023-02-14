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
            {{ Form::label('Nombre') }}
            {{ Form::text('Nombre', $insumo->Nombre, ['class' => 'form-control' . ($errors->has('Nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
            {!! $errors->first('Nombre', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group">
            {{ Form::label('Precio') }}
            {{ Form::text('Precio', $insumo->Precio, ['class' => 'form-control' . ($errors->has('Precio') ? ' is-invalid' : ''), 'placeholder' => 'Precio']) }}
            {!! $errors->first('Precio', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group">
            {{ Form::label('Tipo Cantidad') }}
            {{ Form::select('TipoCantidad',['Kilogramo' => 'Kilogramos', 'Gramo' => 'Gramos', 'Unidades' => 'Unidades', 'Litros' => 'Litros',  'Mililitros' => 'Mililitros'], $insumo->TipoCantidad, ['class' => 'form-control' . ($errors->has('TipoCantidad') ? ' is-invalid' : ''), 'placeholder' => 'Tipo Cantidad']) }}
            {!! $errors->first('TipoCantidad', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        
    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>
</div>