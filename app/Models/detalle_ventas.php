<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detalle_ventas extends Model
{
    use HasFactory;

    protected $table='detalle_ventas';

   protected $fillable=[
    'idVenta',
    'idProducto',
    'Cantidad'
   ];

    public $timestamps=false;
}
