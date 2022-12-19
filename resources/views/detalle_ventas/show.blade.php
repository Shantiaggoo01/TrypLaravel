<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
    <title>Detalle de venta</title>
</head>
<body>
<h1>Detalle de venta</h1>
<br>
<h2>Informacion de la venta</h2>

@foreach ($ventas as $venta)

<p>ID de venta: {{$venta->id}}</p>
<p>Nombre del Cliente: {{ $venta->cliente }}</p>
<p>Fecha de Venta: {{ $venta->FechaVenta }}</p>
<p>Total de venta: {{ $venta->Total }}</p>                                  

@endforeach


<h2>Detalle de los productos</h2>
<div class="card-body">
    <div class="table-responsive">
        <table id="" class="table table-striped table-hover">
            <thead class="thead">
                <tr>
                    <th>Nombre</th>
                                        
					<th>Cantidad</th>
					<th>Precio</th>
					<th>SubTotal</th>

                    <th></th>
                </tr>
            </thead>
                <tbody>
                    @foreach ($productos as $producto)
                        <tr>
                            <td>{{$producto->nombre}}</td>
                                            
							<td>{{ $producto->cantidad_c }}</td>
							<td>{{ $producto->precio }}</td>
							<td>{{ $producto->precio * $producto->cantidad_c }}</td>
                                           

                                          
                        </tr>
                    @endforeach
                </tbody>
        </table>
    </div>
</div>

</body>
</html>
