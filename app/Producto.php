<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    //

    protected $fillable = [
    	"nombre",
        "descripcion",
    	"talla",
    	"equipo",
    	"tipo_producto",
    	"proveedor",
    	"iva",
    	"precio_compra",
    	"pvp",
    	"codigo_barras",
    	"stock_actual",
    	"stock_maximo",
    	"stock_minimo",
    	"foto",
    	"activo",
        "rebajado",
        "rebaja_inicio",
        "rebaja_fin"
    ];

    public function pedido_item()
    {
        return $this->hasOne('App\PedidoItem');
    }

    public function comentario_producto() {
        return $this->hasMany('App\ComentarioProducto');
    }
}
