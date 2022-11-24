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
<div class="float-right">
    <a href="{{ route('usuarios.create') }}" class="btn btn-primary btn-sm float-right" data-placement="left">
        {{ __('Registrar Usuario') }}
    </a>
</div>


<div class="table-responsive">
    <br>

    <table id="example" class="table table-striped table-hover">
        <thead class="thead">
            <tr>

                <th>ID</th>
                <th>Documento</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Telefono</th>
                <th>Rol</th>
                <th>Email</th>



                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>

                <td>{{ $user->id }}</td>
                <td>{{ $user->documento}}</td>
                <td>{{ $user->name}}</td>
                <td>{{ $user->apellido }}</td>
                <td>{{ $user->telefono }}</td>
                <td> @if(!empty($user->getRoleNames()))
                    @foreach($user->getRoleNames() as $rolName)
                    <h5><span class="badge badge-dark">{{$rolName}}</span></h5>
                    @endforeach
                    @endif
                </td>
                <td>{{ $user->email }}</td>

                <td>
                    <form action="{{ route('usuarios.destroy',$user->id) }}" method="POST">
                        <a class="btn btn-sm btn-success" href="{{route('usuarios.edit', $user->id)}}"> Editar </a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


@endsection