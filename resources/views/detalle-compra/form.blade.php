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
            {{ Form::label('id_Compra') }}
            {{ Form::text('id_Compra', $detalleCompra->id_Compra, ['class' => 'form-control' . ($errors->has('id_Compra') ? ' is-invalid' : ''), 'placeholder' => 'Id Compra']) }}
            {!! $errors->first('id_Compra', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('precio_Unitario') }}
            {{ Form::text('precio_Unitario', $detalleCompra->precio_Unitario, ['class' => 'form-control' . ($errors->has('precio_Unitario') ? ' is-invalid' : ''), 'placeholder' => 'Precio Unitario']) }}
            {!! $errors->first('precio_Unitario', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('precio_Total') }}
            {{ Form::text('precio_Total', $detalleCompra->precio_Total, ['class' => 'form-control' . ($errors->has('precio_Total') ? ' is-invalid' : ''), 'placeholder' => 'Precio Total']) }}
            {!! $errors->first('precio_Total', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('id_Insumos') }}
            {{ Form::text('id_Insumos', $detalleCompra->id_Insumos, ['class' => 'form-control' . ($errors->has('id_Insumos') ? ' is-invalid' : ''), 'placeholder' => 'Id Insumos']) }}
            {!! $errors->first('id_Insumos', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('cantidad') }}
            {{ Form::text('cantidad', $detalleCompra->cantidad, ['class' => 'form-control' . ($errors->has('cantidad') ? ' is-invalid' : ''), 'placeholder' => 'Cantidad']) }}
            {!! $errors->first('cantidad', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>