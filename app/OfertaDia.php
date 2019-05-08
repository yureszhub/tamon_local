<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OfertaDia extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'producto_id', 'descuento',
    ];

    public function scopeBuscarProducto($query, $codigo) {
    	if (trim($codigo) != "") {
    		return $query->Join('productos','productos.id','=','oferta_dias.producto_id')
    					->where('oferta_dias.producto_id', '=', $codigo)
    					->select('producto_id','descuento')
    					->get();
    	}
    }
}
