<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Suscriptores extends Model
{
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'correo',
    ];
}
