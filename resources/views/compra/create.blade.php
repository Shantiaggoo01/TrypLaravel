


@extends('layouts.app2')

@section('template_title')
    CrearCompra
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        
                        <span class="card-title">Create Compra</span>
                        
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('compras.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('compra.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
