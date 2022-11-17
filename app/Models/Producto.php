<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Producto
 *
 * @property $idproducto
 * @property $nombre
 * @property $tamaño
 * @property $sabor
 * @property $invima
 * @property $peso
 * @property $cantidad
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Producto extends Model
{
    
    static $rules = [
		'idproducto' => 'required',
		'nombre' => 'required',
		'tamaño' => 'required',
		'sabor' => 'required',
		'invima' => 'required',
		'peso' => 'required',
		'cantidad' => 'required',
    ];

    protected $perPage = 20;
    protected $primaryKey = 'idproducto';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['idproducto','nombre','tamaño','sabor','invima','peso','cantidad'];



}
