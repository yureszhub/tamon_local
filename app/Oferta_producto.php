<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Oferta_producto extends Model
{
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'oferta_id', 'producto_id',
    ];
}
