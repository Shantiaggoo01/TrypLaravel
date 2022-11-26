@extends('layouts.app2')

@section('template_title')
Crear Usuarios
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

<section class="content container-fluid">

    @includeif('partials.errors')

    <div class="card card-default">
        <div class="card-header">
            <span class="card-title">Crear Rol</span>
        </div>
        <div class="card-body">

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


            {!!Form::open(array('route'=>'roles.store','method'=>'POST'))!!}
            <!-- <div class="row">
                <div class="col-md-12">

                    <div class="form-group">
                        <label for="">Nombre del rol</label>
                        {!!Form::text('name',null,array('class'=>'form-control'))!!}
                    </div>
                </div>

                <div class="col-md-12 ">
                    <div class="form-group">

                        <label for="">Permisos para este Rol:</label>
                        <br>
                        @foreach($permission as $value)
                        <label>{{Form::checkbox('permission[]',$value->id,false,array('class'=>'name'))}}{{$value->name}}</label>
                        <br />
                        @endforeach
                    </div>
                </div> -->


            <div class="form-group">
                <label for="">Nombre del rol</label>
                {!!Form::text('name',null,array('class'=>'form-control'))!!}
            </div>


            <table id="example" class="table table-striped table-hover">
                <thead class="thead">
                    <tr>
                        <th> -- Seleccione -- </th>
                        <th> <label for="">Permisos para este Rol:</label></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($permission as $value)
                    <tr>
                        <td><label>{{Form::checkbox('permission[]',$value->id,false,array('class'=>'name'))}}</label></td>
                        <td><label> {{$value->name}}</label></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="col-md-12">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </div>
        {!!Form::close()!!}


    </div>
    </div>
    </div>



    </div>
    </div>
    </div>
    </div>
</section>




@endsection