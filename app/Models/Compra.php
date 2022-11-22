<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Compra
 *
 * @property $nFactura
 * @property $id_proveedor
 * @property $id_insumo
 * @property $totalCompra
 * @property $iva
 * @property $created_at
 * @property $updated_at
 *
 * @property DetalleCompra[] $detalleCompras
 * @property Insumo $insumo
 * @property Proveedore $proveedore
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Compra extends Model
{
    
    static $rules = [
		'nFactura' => 'required',
		'id_proveedor' => 'required',
		'id_insumo' => 'required',
		'totalCompra' => 'required',
		'iva' => 'required',
    ];

    protected $perPage = 20;
    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nFactura','id_proveedor','id_insumo','totalCompra','iva'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detalleCompras()
    {
        return $this->hasMany('App\Models\DetalleCompra', 'id_Compra', 'nFactura');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function insumo()
    {
        return $this->hasOne('App\Models\Insumo', 'id', 'id_insumo');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function proveedore()
    {
        return $this->hasOne('App\Models\Proveedore', 'id', 'id_proveedor');
    }
    

}
