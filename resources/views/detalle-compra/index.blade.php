@extends('layouts.app')

@section('template_title')
    Detalle Compra
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Detalle Compra') }}
                            </span>
                            
                             <div class="float-right">
                             @can('crear-detallecompra')
                                <a href="{{ route('detalle-compra.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
                                </a>
                                @endcan
                              </div>
                              
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        
										<th>Id Compra</th>
										<th>Precio Unitario</th>
										<th>Precio Total</th>
										<th>Id Insumos</th>
										<th>Cantidad</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($detalleCompras as $detalleCompra)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $detalleCompra->id_Compra }}</td>
											<td>{{ $detalleCompra->precio_Unitario }}</td>
											<td>{{ $detalleCompra->precio_Total }}</td>
											<td>{{ $detalleCompra->id_Insumos }}</td>
											<td>{{ $detalleCompra->cantidad }}</td>

                                            <td>
                                                <form action="{{ route('detalle-compras.destroy',$detalleCompra->id) }}" method="POST">
                                                    
                                                    <a class="btn btn-sm btn-primary " href="{{ route('detalle-compras.show',$detalleCompra->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    @can('editar-detallecompra')
                                                    <a class="btn btn-sm btn-success" href="{{ route('detalle-compras.edit',$detalleCompra->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
                                                    @endcan
                                                    @csrf
                                                    @method('DELETE')
                                                    @can('borrar-detallecompra')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Delete</button>
                                                    @endcan
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $detalleCompras->links() !!}
            </div>
        </div>
    </div>
@endsection
