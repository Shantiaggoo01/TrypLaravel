@extends('layouts.app')

@section('template_title')
    {{ $compra->name ?? 'Show Compra' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Compra</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('compras.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Nfactura:</strong>
                            {{ $compra->nFactura }}
                        </div>
                        <div class="form-group">
                            <strong>Id Proveedor:</strong>
                            {{ $compra->id_proveedor }}
                        </div>
                        <div class="form-group">
                            <strong>Id Insumo:</strong>
                            {{ $compra->id_insumo }}
                        </div>
                        <div class="form-group">
                            <strong>Totalcompra:</strong>
                            {{ $compra->totalCompra }}
                        </div>
                        <div class="form-group">
                            <strong>Iva:</strong>
                            {{ $compra->iva }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
