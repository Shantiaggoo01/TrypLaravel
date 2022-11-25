<div class="box box-info padding-1">
    <div class="box-body">

        <div class="form-group">
            {{ Form::label('nFactura') }}
            {{ Form::text('nFactura', $compra->nFactura, ['class' => 'form-control' . ($errors->has('nFactura') ? ' is-invalid' : ''), 'placeholder' => 'Nfactura']) }}
            {!! $errors->first('nFactura', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            @can('crear-proveedor')
            <a href="{{ route('proveedores.create') }}" class="btn btn-primary btn-sm float-right" data-placement="left">
            @endcan
                {{ __('Agregar Nuevo Proveedor') }}
            </a>
            
            <br />

            {{ Form::label('Seleccione el proveedor') }}
            {{ Form::select('id_proveedor',$proveedores, $compra->id_proveedor, ['class' => 'form-control' . ($errors->has('id_proveedor') ? ' is-invalid' : ''), 'placeholder' => '---Seleccione---']) }}
            {!! $errors->first('id_proveedor', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            @can('crear-insumos')
            <a href="{{ route('insumos.create') }}" class="btn btn-primary btn-sm float-right" data-placement="left">
                {{ __('Agregar Nuevo Insumo') }}
            </a>
            @endcan
            <br />
            {{ Form::label('seleccione el Insumo') }}
            {{ Form::select('id_insumo',$insumos, $compra->id_insumo, ['class' => 'form-control' . ($errors->has('id_insumo') ? ' is-invalid' : ''), 'placeholder' => '---Seleccione---']) }}
            {!! $errors->first('id_insumo', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('totalCompra') }}
            {{ Form::text('totalCompra', $compra->totalCompra, ['class' => 'form-control' . ($errors->has('totalCompra') ? ' is-invalid' : ''), 'placeholder' => 'Totalcompra']) }}
            {!! $errors->first('totalCompra', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('iva') }}
            {{ Form::text('iva', $compra->iva, ['class' => 'form-control' . ($errors->has('iva') ? ' is-invalid' : ''), 'placeholder' => 'Iva']) }}
            {!! $errors->first('iva', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>