@extends('layouts.app2')

@section('template_title')
Usuario
@endsection
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
@endsection
@section('js')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.13.1/i18n/es-ES.json"
            }
        });
    });
</script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@if ($message = Session::get('success') )
<script>
    swal({
        title: "{{session::get('success')}}",
        icon: "success",
        button: "Aceptar",
    });
</script>
@endif
@endsection


@section('content')


<!-- Body -->
<div class="container position-relative">
    <div class="row d-flex justify-content-center">
        <div class="col-md-8 col-lg-6 col-xl-5 col-xxl-12">
            <div class="card mb-5">
                <div class="card-body text-center shadow"><img class="rounded-circle mb-3 mt-4" src="https://definicion.de/wp-content/uploads/2019/07/perfil-de-usuario.png" width="160" height="160">
                <h3 class="title mt-3"><b> {{ $user->name}} {{ $user->apellido }}</b></h3>
                <hr>
                    <div class="mb-3">
                    <i class="title mt-3"><b>Documento&nbsp;:&nbsp;</b> </i> {{ $user->documento}}<br>
                    <i class="title mt-3"><b>Telefono&nbsp;:&nbsp;</b></i>{{ $user->telefono }}<br>
                    <i class="title mt-3"><b>Rol&nbsp;:&nbsp;</b></i> @if(!empty($user->getRoleNames()))
                       <i style="color:red"> @foreach($user->getRoleNames() as $rolName)
                        {{$rolName}}
                        @endforeach
                        @endif
                       </i>
                        <br>
                        <i class="title mt-3"><b>Correo Electronico</b>&nbsp;:&nbsp;</i> {{ $user->email }}</i><br>
                        
                        <h6 class="title mt-3"><b>Fecha De Creaccion&nbsp;:&nbsp; {{ $user->created_at }}</b></h6>
                    </div>
                    <button onclick="history.back()" type="button" class="btn btn-primary float-center">Atras</button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection