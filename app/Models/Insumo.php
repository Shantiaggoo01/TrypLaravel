<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Insumo
 *
 * @property $id
 * @property $Nombre
 * @property $Precio
 * @property $TipoCantidad
 * @property $Estado
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Insumo extends Model
{

  static $rules = [
    'Nombre' => 'required',
    'Precio' => 'required',
    'TipoCantidad' => 'required',
    'cantidad',
    'Estado' => 'in:Activo,Inactivo',
  ];

  protected $perPage = 20;

  /**
   * Attributes that should be mass-assignable.
   *
   * @var array
   */
  protected $fillable = ['Nombre', 'Precio', 'TipoCantidad', 'Estado','cantidad'];
}
