@section('script')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.0.0/html2canvas.min.js"></script>
<script>
    // Agrega un evento click al botón
    document.getElementById('convertir-a-imagen').addEventListener('click', function() {
        // Crea un objeto JsPdf
        const doc = new jsPDF();
        
        // Selecciona la vista que deseas convertir a imagen
        const element = document.getElementById('venta');
        
        // Convierte la vista en una imagen utilizando html2canvas
        html2canvas(element).then((canvas) => {
            // Agrega la imagen a tu objeto JsPdf
            const imgData = canvas.toDataURL('image/png');
            doc.addImage(imgData, 'PNG', 10, 10, 100, 100);
            
            // Exporta el archivo
            doc.save('vista.pdf');
        });
    });
</script>
En el código anterior, 'vista-a-convertir' es el identificador único de la vista que deseas convertir a imagen. También puedes ajustar los parámetros de la función addImage para personalizar la posición y el tamaño de la imagen en tu archivo PDF.






@endsection


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.3/jspdf.umd.min.js"></script>
    <title>venta</title>
    
</head>
<body>
@extends('layouts.app2')

@section('template_title')
    {{ $cliente->name ?? 'Show Cliente' }}
@endsection

@section('content')
    <section class="content container-fluid" id="venta">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title"></span>
                        </div>
                      
                    </div>

                    <div class="card-body">
                        <button type="button" id="convertir-a-imagen">Convertir a imagen</button>
                    
                    <div class="row card-body">
                        <div class="form-group col-6">
                         <h1>Detalle de venta</h1>

                        </div>
                    
                        <div class="form-group col-6">
                            <h2>Total de venta: {{ $venta->Total }}</h2>
                        </div>

                    </div>
                    <br>
                    

                    @foreach ($ventas as $venta)
                   
                        
                    <h2>Informacion de la venta</h2>
                    <td>ID de venta: {{$venta->id}}</td>
                    <p>NIT del cliente: {{$venta->NIT}}</p>
                    <p>Nombre del cliente: {{ $venta->cliente }} {{$venta->apellido}}</p>
                    <p>Tipo de cliente: {{ $venta->nombre_tipo }}</p>
                    <p>Fecha de venta: {{ $venta->FechaVenta }}</p>

                                                   

                    @endforeach


                    <h2>Detalle de los productos</h2>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="" class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Sabor</th>
                                        <th>Tamaño</th>
                                        <th>Peso</th>            
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
                                                <td>{{$producto->sabor}}</td>
                                                <td>{{$producto->tamaño}}</td>  
                                                <td>{{$producto->peso}}</td>         
                                                <td>{{ $producto->cantidad_c }}</td>
                                                <td>{{ $producto->precio }}</td>
                                                <td>{{ $producto->precio * $producto->cantidad_c }}</td>
                                                            

                                                            
                                            </tr>
                                        @endforeach
                                    </tbody>
                            </table>
                        </div>
                    </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

<script>
    
</script>


<!-- </body>
</html> -->
