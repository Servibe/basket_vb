<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    //

    protected $fillable = [
    	"nombre",
    	"correo",
    	"telefono",
    	"localidad",
    	"provincia",
    	"calle",
    	"pais",
    	"cod_postal",
        'activo'
    ];
}
