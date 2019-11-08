<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    //

    protected $fillable = [
        "user_id",
    	"nombre",
    	"apellidos",
    	"localidad",
    	"provincia",
    	"calle",
    	"cod_postal",
        "recibir_ofertas",
    	"activo",
    ];

    public function user() {

    	return $this->belongsTo('App\User');
    }

    public function factura() {
        return $this->belongsTo('App\Factura');
    }
}
