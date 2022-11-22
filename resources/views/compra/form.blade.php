<div class="box box-info padding-1">
    <div class="box-body">

        <div class="form-group">
            {{ Form::label('id') }}
            {{ Form::text('id', $compra->totalCompra, ['class' => 'form-control' . ($errors->has('id') ? ' is-invalid' : ''), 'placeholder' => 'id']) }}
            {!! $errors->first('id', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group">

        <a href="{{ route('proveedores.create') }}" class="btn btn-primary btn-sm float-right" data-placement="left">
                {{ __('Agregar Nuevo Proveedor') }}
            </a>

            {{ Form::label('Seleccione el proveedor') }}
            {{ Form::select('id_proveedor',$proveedores, $compra->id_proveedor, ['class' => 'form-control' . ($errors->has('id_proveedor') ? ' is-invalid' : ''), 'placeholder' => '---Seleccione---']) }}
            {!! $errors->first('id_proveedor', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group">

            <a href="{{ route('insumos.create') }}" class="btn btn-primary btn-sm float-right" data-placement="left">
                {{ __('Agregar Nuevo Insumo') }}
            </a>

            {{ Form::label('seleccione el Insumo') }}
            {{ Form::select('id_insumo',$insumos, $compra->id_insumo, ['class' => 'form-control' . ($errors->has('id_insumo') ? ' is-invalid' : ''), 'placeholder' => '---Seleccione---']) }}
            {!! $errors->first('id_insumo', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group">
            {{ Form::label('Total De La Compra') }}
            {{ Form::text('totalCompra', $compra->totalCompra, ['class' => 'form-control' . ($errors->has('totalCompra') ? ' is-invalid' : ''), 'placeholder' => '']) }}
            {!! $errors->first('totalCompra', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group">
            {{ Form::label('iva') }}
            {{ Form::text('iva', $compra->iva, ['class' => 'form-control' . ($errors->has('iva') ? ' is-invalid' : ''), 'placeholder' => 'Iva']) }}
            {!! $errors->first('iva', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Crear</button>
    </div>
</div>