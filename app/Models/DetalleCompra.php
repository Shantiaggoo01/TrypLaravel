<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DetalleCompra
 *
 * @property $id
 * @property $id_Compra
 * @property $precio_Unitario
 * @property $precio_Total
 * @property $id_Insumos
 * @property $cantidad
 * @property $created_at
 * @property $updated_at
 *
 * @property Compra $compra
 * @property Insumo $insumo
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class DetalleCompra extends Model
{
    
    static $rules = [
		'id_Compra' => 'required',
		'precio_Unitario' => 'required',
		'precio_Total' => 'required',
		'id_Insumos' => 'required',
		'cantidad' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['id_Compra','precio_Unitario','precio_Total','id_Insumos','cantidad'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function compra()
    {
        return $this->hasOne('App\Models\Compra', 'nFactura', 'id_Compra');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function insumo()
    {
        return $this->hasOne('App\Models\Insumo', 'id', 'id_Insumos');
    }
    

}
