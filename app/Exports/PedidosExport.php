<?php

namespace App\Exports;

use App\User;
use App\Pedido;
use App\Pedido_Item;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PedidosExport implements FromCollection, WithHeadings
{
	/**
    * @return \Illuminate\Support\Collection
    */
	public function headings(): array {

		return [
		'Pedido',
		'Id Usuario',
		'Subtotal',
		'Coste Envio',
		'Id Factura',
		'Unidades',
		'Precio',
		'Fecha Pedido',
		'Fecha Envio',
		'Fecha Entrega',
		'Fecha Factura',
		'Método de Pago',
		];
	}

	public function collection() {

		$fecha1 = \Request::get('fecha1');
		$fecha2 = \Request::get('fecha2');

		if (isset($_GET['fechas'])) {
			$pedidos = \DB::table('pedidos')
			->join('pedido_items', 'pedidos.id', '=', 'pedido_items.pedido_id')
			->join('facturas', 'pedidos.factura_id', '=', 'facturas.pedido_id')
			->select('pedidos.id', 'pedidos.user_id', 'pedidos.subtotal', 'pedidos.envio', 'pedidos.factura_id', 'pedido_items.unidades', 'pedido_items.precio', 'pedidos.fecha_pedido', 'pedidos.fecha_envio', 'pedidos.fecha_entrega', 'facturas.fecha_factura', 'pedidos.metodo_pago')
			->whereBetween('pedidos.fecha_pedido', [$fecha1, $fecha2])->get();
		} else if (isset($_GET['todos'])) {
			$pedidos = \DB::table('pedidos')
			->join('pedido_items', 'pedidos.id', '=', 'pedido_items.pedido_id')
			->join('facturas', 'pedidos.factura_id', '=', 'facturas.pedido_id')
			->select('pedidos.id', 'pedidos.user_id', 'pedidos.subtotal', 'pedidos.envio', 'pedidos.factura_id', 'pedido_items.unidades', 'pedido_items.precio', 'pedidos.fecha_pedido', 'pedidos.fecha_envio', 'pedidos.fecha_entrega', 'facturas.fecha_factura', 'pedidos.metodo_pago')
			->get();
		}

		return $pedidos;
	}
}