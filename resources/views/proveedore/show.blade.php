@extends('layouts.app2')

@section('template_title')
    {{ $proveedore->name ?? 'Show Proveedore' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Proveedore</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('proveedores.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Nit:</strong>
                            {{ $proveedore->nit }}
                        </div>
                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $proveedore->nombre }}
                        </div>
                        <div class="form-group">
                            <strong>Razón Social:</strong>
                            {{ $proveedore->razon_social }}
                        </div>
                        <div class="form-group">
                            <strong>Direccion:</strong>
                            {{ $proveedore->direccion }}
                        </div>
                        <div class="form-group">
                            <strong>Telefono:</strong>
                            {{ $proveedore->telefono }}
                        </div>
                        <div class="form-group">
                            <strong>Regimen:</strong>
                            {{ $regimen }}
                        </div>
                        <div class="form-group">
                            <strong>Banco:</strong>
                            {{ $proveedore->banco }}
                        </div>
                        <div class="form-group">
                            <strong>Cuenta:</strong>
                            {{ $proveedore->cuenta }}
                        </div>
                        <div class="form-group">
                            <strong>Tipo de cuenta:</strong>
                            {{ $tiposCuenta }}
                        </div>
                        <div class="form-group">
                            <strong>Tipo de Proveedor:</strong>
                            {{ $tipo_proveedors }}
                        </div>
                        <div class="form-group">
                            <strong>Nombre del contacto:</strong>
                            {{ $proveedore->NombreContacto }}
                        </div>
                        <div class="form-group">
                            <strong>Teléfono del contacto:</strong>
                            {{ $proveedore->TelefonoContacto }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
