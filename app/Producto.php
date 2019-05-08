<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nom_producto', 'desc_producto', 'img_producto', 'precio', 'categoria_id', 'precio_anterior',
    ];

    public function scopeName($query, $name) {
    	if (trim($name) != "") {
    		return $query->where('nom_producto', "LIKE", "%$name%");
    	}
    }
}
