<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DetalleProducto
 *
 * @property $id
 * @property $idproducto
 * @property $idinsumo
 * @property $cantidad
 * @property $created_at
 * @property $updated_at
 *
 * @property Insumo $insumo
 * @property Producto $producto
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class DetalleProducto extends Model
{
    
    static $rules = [
		'idproducto' => 'required',
		'idinsumo' => 'required',
		'cantidad' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['idproducto','idinsumo','cantidad'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function insumo()
    {
        return $this->hasOne('App\Models\Insumo', 'id', 'idinsumo');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function producto()
    {
        return $this->hasOne('App\Models\Producto', 'idproducto', 'idproducto');
    }
    

}
