<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    //

    protected $fillable = [
    	'subtotal',
        'envio',
        'user_id',
        'factura_id',
        'metodo_pago',
        'fecha_pedido',
        'fecha_envio',
        'fecha_entrega'
    ];

    public function user() {
        return $this->belongsTo('App\User');
    } 

    public function pedido_items() {
        return $this->hasMany('App\PedidoItem');
    }

    public function facturas() {
        return $this->hasOne('App\Factura');
    }
}
