@section('js'){
<script>



    $(document).ready(function(){

        $('#agregarprodu').click(function(){ 

            let insumo_id = document.getElementById("insumos").value;
            let insumo = document.getElementById("insumos");
            let selected = insumos.options[insumos.selectedIndex].text;
            let cantidad = document.getElementById("cantidad").value;
            let tipo_Cantidad = document.getElementById("tipo-cantidad").value;
            console.log(insumo_id);
            
            if (cantidad > 0 ){
            $("#datosresumen").append(`
                                
                                <tr id="tr-${insumo_id}">
                                <input type="hidden" name="producto_id[]" value="${producto_id}"/>
                                <input type="hidden" name="cantidades[]" value="${cantidad}"/>
                                <input type="hidden" name="tipo_cantidad[]" value="${tipo-cantidad}"/>
                                <td>
                                ${selected}
                                </td>
                                <td>${cantidad}</td>
                                <td>${tipo-cantidad}</td>
                                <td><a type="button" class="mdi mdi-close-circle" style="color:red;font-size:100%" id="eliminar" onclick="eliminarclick(${producto_id}"></a></td>     
                                </tr>

                                `);
        }});

     });
    </script>
}

@endsection
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
            {{ Form::label('idproducto') }}
            {{ Form::text('idproducto', $producto->idproducto, ['class' => 'form-control' . ($errors->has('idproducto') ? ' is-invalid' : ''), 'placeholder' => 'Idproducto']) }}
            {!! $errors->first('idproducto', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('nombre') }}
            {{ Form::text('nombre', $producto->nombre, ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
            {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('tamaño') }}
            {{ Form::text('tamaño', $producto->tamaño, ['class' => 'form-control' . ($errors->has('tamaño') ? ' is-invalid' : ''), 'placeholder' => 'Tamaño']) }}
            {!! $errors->first('tamaño', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('sabor') }}
            {{ Form::text('sabor', $producto->sabor, ['class' => 'form-control' . ($errors->has('sabor') ? ' is-invalid' : ''), 'placeholder' => 'Sabor']) }}
            {!! $errors->first('sabor', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('invima') }}
            {{ Form::text('invima', $producto->invima, ['class' => 'form-control' . ($errors->has('invima') ? ' is-invalid' : ''), 'placeholder' => 'Invima']) }}
            {!! $errors->first('invima', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('peso') }}
            {{ Form::text('peso', $producto->peso, ['class' => 'form-control' . ($errors->has('peso') ? ' is-invalid' : ''), 'placeholder' => 'Peso']) }}
            {!! $errors->first('peso', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('cantidad') }}
            {{ Form::text('cantidad', $producto->cantidad, ['class' => 'form-control' . ($errors->has('cantidad') ? ' is-invalid' : ''), 'placeholder' => 'Cantidad']) }}
            {!! $errors->first('cantidad', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <h4>Información Productos</h4>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label  class="control-label">Insumos</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="insumos" id="insumos">
                                @forelse($insumos  as $insumo)
                                <option value="{{$insumo->id}}">
                               {{ $insumo->Nombre}}
                               </option>
                                @empty <option>No existen</option>
                               @endforelse
                            </select> 
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group row">
                        <label  class="control-label">Cantidad</label>
                        <div class="col-sm-9">
                            <input type="number" id="cantidad" class="form-control" />

                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group row">
                        <label class="control-label">Tipo Cantidad</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="tipo-cantidad" id="tipo-cantidad">
                                <option value="1">
                                    Gramos
                                </option>
                                <option value="2">
                                    Kilos
                                </option>
                                <option value="3">
                                    Unidades
                                </option>
                            </select> 
                        </div>
                    </div>
                </div>
                
                </div>
                </div>
                
            </div>
                <div style="margin-top: 2%;">
                    <a type="button" class="btn btn-primary" style="color:green;font-size:400%;margin-left:40%" id="agregarprodu" ></a>
                    <a type="button" class="btn btn-danger" style="color:red;font-size:400%;margin-left:8%"></a>
                </div>

                <div style="margin-top: 3%;">
                    <table id="resumen" class="table table-striped dt-responsive nowrap"
                        style="width:70%;margin-left:15%">
                        <thead>
                            <tr>
                                <th>Imagen</th>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Precio </th>
                                <th>Subtotal</th>
                                <th>Descripción</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th>TOTAL</th>
                            
                            <th id="totalpedido" name="totalpedido"></th>
                        </tfoot>
                        <tbody id=datosresumen>

                        </tbody>
                    </table>

                </div>

            </div>
    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>