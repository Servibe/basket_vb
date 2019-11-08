<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PedidoItem extends Model
{
    //

    protected $table = "pedido_items";

    protected $fillable = [
    	'precio',
    	'unidades',
        'rebaja',
    	'producto_id',
    	'pedido_id'
    ];

    public function pedido() {
    	return $this->belongsTo('App\Pedido');
    }

    public function producto() {
    	return $this->belongsTo('App\Producto');
    }
}
