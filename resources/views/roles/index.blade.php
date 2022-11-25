@extends('layouts.app2')

@section('template_title')
Roles
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
        $('#example').DataTable();
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

<section class="content container-fluid">

    @includeif('partials.errors')

    <div class="card card-default">
        <div class="card-header">
            <span class="card-title">Crear Rol</span>
        </div>
        <div class="card-body">
            @can('crear-rol')
            <a class="btn btn-primary" href="{{route('roles.create')}}"> Crear Rol</a>
            @endcan
            <table id="example" class="table table-striped table-hover">
                <thead class="thead">
                    <tr>
                        <th>id</th>
                            <th>Rol</th>
                            <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        @foreach ($roles as $role)
                        <td>{{ $role->id }}</td>
                        <td>{{ $role->name }}</td>
                        <td>
                            @can('editar-rol')
                            <a class="btn btn-primary" href="{{route('roles.edit',$role->id)}}"> Editar </a>
                            @endcan
                            @can('borrar-rol')
                            {!!Form::open(['method'=>'DELETE','route'=>['roles.destroy',$role->id],'style'=>'display:inline'])!!}
                            {!!Form::submit('Borrar',['class' => 'btn btn-danger'])!!}
                            {!!Form::close()!!}
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection