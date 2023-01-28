@extends('layouts.app')

@section('template_title')
    {{ $produccion->name ?? 'Show Produccion' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Produccion</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('produccions.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Fecha Producción:</strong>
                            {{ $produccion->fecha_producción }}
                        </div>
                        <div class="form-group">
                            <strong>Cantidad:</strong>
                            {{ $produccion->cantidad }}
                        </div>
                        <div class="form-group">
                            <strong>Fecha Vencimiento:</strong>
                            {{ $produccion->fecha_vencimiento }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
