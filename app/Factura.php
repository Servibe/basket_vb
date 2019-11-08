<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    //

    protected $fillable = [
    	"user_id",
        "pedido_id",
    	"total",
    	"fecha_factura"
    ];

    public function pedido() {
        return $this->belongsTo('App\Pedido');
    }

    public function clientes() {
        return $this->hasMany('App\Cliente');
    }
}
