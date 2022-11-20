@extends('layouts.app')

@section('template_title')
    {{ $detalleCompra->name ?? 'Show Detalle Compra' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Detalle Compra</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('detalle-compras.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Id Compra:</strong>
                            {{ $detalleCompra->id_Compra }}
                        </div>
                        <div class="form-group">
                            <strong>Precio Unitario:</strong>
                            {{ $detalleCompra->precio_Unitario }}
                        </div>
                        <div class="form-group">
                            <strong>Precio Total:</strong>
                            {{ $detalleCompra->precio_Total }}
                        </div>
                        <div class="form-group">
                            <strong>Id Insumos:</strong>
                            {{ $detalleCompra->id_Insumos }}
                        </div>
                        <div class="form-group">
                            <strong>Cantidad:</strong>
                            {{ $detalleCompra->cantidad }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
