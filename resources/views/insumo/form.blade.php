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
            {{ Form::label('Tipo de unidad de medida') }}
            {{ Form::select('TipoCantidad',['Kilogramo' => 'Kilogramos', 'Gramo' => 'Gramos', 'Unidades' => 'Unidades', 'Litros' => 'Litros',  'Mililitros' => 'Mililitros'], $insumo->TipoCantidad, ['class' => 'form-control' . ($errors->has('TipoCantidad') ? ' is-invalid' : ''), 'placeholder' => 'Selección']) }}
            {!! $errors->first('TipoCantidad', '<div class="invalid-feedback"></div>') !!}
            @error('TipoCantidad')
                <small class="text-danger">{{ str_replace("tipo cantidad","tipo de unidad de medida",$errors->first('TipoCantidad')) }}</small>
            @enderror
        </div>

        <div class="form-group">
            {{ Form::label('Cantidad De Medida') }}
            {{ Form::number('Medida', $insumo->Medida, ['class' => 'form-control' . ($errors->has('Medida') ? ' is-invalid' : ''), 'placeholder' => 'cantidad de medida']) }}
            {!! $errors->first('Medida', '<div class="invalid-feedback"></div>') !!}
            @error('Medida')
                <small class="text-danger">{{ str_replace("medida","cantidad de medida",$errors->first('Medida')) }}</small>
            @enderror
        </div>
        
    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>
</div>