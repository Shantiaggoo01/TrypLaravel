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

@if(Session::has('success'))
    <script>
        swal({
            title: "{{ Session::get('success') }}",
            icon: "success",
            button: "Aceptar",
        });
        {{ session()->forget('success') }}
    </script>
@endif


@if(session('error'))
<script>
    swal({
        title: "{{session::get('error')}}",
        icon: "error",
        button: "Aceptar",
    });
    {{ session()->forget('success') }}
</script>
@endif

<script>
    //confirmacion de eliminar 
    function confirmacion() {
        var respuesta = confirm("¿Seguro que desea eliminar este usuario?");

        if (respuesta == true) {
            return true;
        } else {
            return false;
        }

        //'onclick'=>'return confirmacion()'
    }
</script>

<style>
    .role-label {
        display: inline-block;
        padding: 4px 10px;
        border-radius: 8px;
        background-color: red;
        color: white;
        font-size: 0.8em;
        text-align: center;
    }
</style>

@endsection

@can('ver-usuario')
@section('content')




<div class="card card-default">
    <div class="card-header">
        <span class="card-title">Usuarios</span>

        @can('crear-usuario')
        <a href="{{ route('usuarios.create') }}" class="btn btn-primary btn-sm float-right" data-placement="left">
            {{ __('Nuevo Usuario') }}
        </a>
        @endcan
    </div>
    <div class="card-body">

        <table id="example" class="table table-striped table-hover">
            <thead class="thead">
                <tr>

                    <th>ID</th>

                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>

                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name}}</td>
                    <td>{{ $user->apellido }}</td>
                    <td> @if(!empty($user->getRoleNames()))
                        @foreach($user->getRoleNames() as $rolName)
                        <h5><span class="role-label">{{$rolName}}</span></h5>
                        @endforeach
                        @endif
                    </td>


                    <td>

                        <a class="btn btn-primary" href="{{route('usuarios.show', $user->id)}}"> Ver Perfil </a>

                        @can('editar-usuario')
                        <a class="btn btn-primary" href="{{route('usuarios.edit',$user->id)}}"> Editar / Asignar Rol </a>
                        @endcan

                        @can('borrar-usuario')
                        {!!Form::open(['method'=>'DELETE','onclick'=>'return confirmacion()','route'=>['usuarios.destroy',$user->id],'style'=>'display:inline'])!!}
                        {!!Form::submit('Borrar',['class' => 'btn btn-danger'])!!}
                        {!!Form::close()!!}
                        @endcan

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    @endsection
    @endcan