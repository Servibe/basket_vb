<?php
$fechas = App\Factura::select('fecha_factura')->where('fecha_factura', $factura2[0]->fecha_factura)->first()->fecha_factura;

$day = date('w', strtotime($fechas));

?>
<!doctype html>

<html>
<head>
	<style>
	.header{background:#eee;color:#444;border-bottom:1px solid #ddd;padding:10px;}
	.client-detail{background:#ddd;padding:10px;}
	.client-detail th{text-align:left;}
	.client-detail td{text-align:right;}

	.items{border-spacing:0;}
	.items thead{background:#ddd;}
	.items tbody{background:#eee;}
	.items tfoot{background:#ddd;}
	.items th{padding:10px;}
	.items td{padding:10px;}

	h1 small{display:block;font-size:16px;color:#888;}

	table{width: 100%;}
	.text-right{text-align: right;}
	</style>
</head>

<body>
	<div class="header">
		<?php
		$fecha = App\Factura::select('fecha_factura')->where('pedido_id', $factura1->id)->first()->fecha_factura;

		$anio = date('Y', strtotime($fecha));

		$mes = date('m', strtotime($fecha));

		$dia = date('d', strtotime($fecha));
		?>
		<h1>Nº Factura {{ $dia . "" . $mes . "" . $factura2[0]->factura_id . "" . $anio }}</h1>
		<h2>Emitida el {{ $factura2[0]->fecha_factura }}</h2>
		@if($day == '4')
		<h2>(Día sin IVA)</h2>
		@endif
	</div>

	<table class="client-detail">
		<tr>
			<th>
				Cliente
			</th>
			<td>{{ $factura1->user->cliente->nombre . " " . $factura1->user->cliente->apellidos }}</td>
		</tr>
		<tr>
			<th>
				Dirección
			</th>
			<td>{{ $factura1->user->cliente->localidad . ", " . $factura1->user->cliente->calle . ", " . $factura1->user->cliente->cod_postal }}</td>
		</tr>
		<tr>
			<th>
				Fecha Pedido
			</th>
			<td>{{ $factura1->created_at->toDateString() }}</td>
		</tr>
		<tr>
			<th>
				Fecha Envío
			</th>
			<td>{{ $factura1->fecha_envio }}</td>
		</tr>
		<tr>
			<th>
				Fecha Entrega
			</th>
			<td>{{ $factura1->fecha_entrega }}</td>
		</tr>
	</table>

	<hr />

	<table class="client-detail">
		<tr>
			<th>
				Nº Cliente
			</th>
			<td>{{ $factura1->user->cliente->id }}</td>
		</tr>
		<tr>
			<th>
				Username
			</th>
			<td>{{ $factura1->user->username}}</td>
		</tr>
	</table>

	<hr />

	<table class="items">
		<thead>
			<tr>
				<th class="text-left">Producto</th>
				<th class="text-right" style="width:100px;">Tipo Producto</th>
				<th class="text-right" style="width:100px;">Unidades</th>
				<th class="text-right" style="width:100px;">Precio (sin IVA)</th>
				<th class="text-right" style="width:100px;">Subtotal</th>
			</tr>
		</thead>

		<tbody>
			@foreach($factura2 as $factura)
			@if(($factura->rebajado) == 0)
			<tr>
				<td>{{ $factura->nombre }}</td>
				<td class="text-right">{{ $factura->tipo_producto }}</td>
				<td class="text-right">{{ $factura->unidades }}</td>
				<td class="text-right">{{ number_format($factura->precio/(1 + ($factura->iva/100)), 2) }} €</td>
				<td class="text-right">{{ number_format($factura->pvp * $factura->unidades, 2) }} €</td>
			</tr>
			@else
			<tr>
				<td>{{ $factura->nombre }} (Producto rebajado)</td>
				<td class="text-right">{{ $factura->tipo_producto }}</td>
				<td class="text-right">{{ $factura->unidades }}</td>
				<td class="text-right">{{ number_format($factura->precio/(1 + ($factura->iva/100)), 2) }} €</td>
				<td class="text-right">{{ number_format($factura->pvp * $factura->unidades, 2) }} €</td>
			</tr>
			@endif
			@endforeach
		</tbody>

		<tfoot>
			@if($day == '4')
			<tr>
				<td colspan="4" class="text-right"><b>Subtotal</b></td>
				<td class="text-right">{{ number_format($factura2[0]->subtotal, 2) }} €</td>
			</tr>
			<tr>
				<td colspan="4" class="text-right"><b>IVA (0 %)</b></td>
				<td class="text-right">0.00 €</td>
			</tr>
			<tr>
				<td colspan="4" class="text-right"><b>Costes de envio</b></td>
				<td class="text-right">{{ number_format($factura2[0]->envio, 2) }} €</td>
			</tr>
			<tr>
				<td colspan="4" class="text-right"><b>Total</b></td>
				<td class="text-right">{{ number_format($factura2[0]->envio + ($factura2[0]->subtotal/(1 + ($factura2[0]->iva/100)) * ($factura2[0]->iva/100)) + ($factura2[0]->subtotal/(1 + ($factura2[0]->iva/100))), 2) }} €</td>
			</tr>
			@else
			<tr>
				<td colspan="4" class="text-right"><b>Subtotal</b></td>
				<td class="text-right">{{ number_format($factura2[0]->subtotal/(1 + ($factura2[0]->iva/100)), 2) }} €</td>
			</tr>
			<tr>
				<td colspan="4" class="text-right"><b>IVA ({{ $factura2[0]->iva }} %)</b></td>
				<td class="text-right">{{ number_format(($factura2[0]->subtotal/(1 + ($factura2[0]->iva/100))) * ($factura2[0]->iva/100), 2) }} €</td>
			</tr>
			<tr>
				<td colspan="4" class="text-right"><b>Costes de envio</b></td>
				<td class="text-right">{{ number_format($factura2[0]->envio, 2) }} €</td>
			</tr>
			<tr>
				<td colspan="4" class="text-right"><b>Total</b></td>
				<td class="text-right">{{ number_format($factura2[0]->envio + ($factura2[0]->subtotal/(1 + ($factura2[0]->iva/100)) * ($factura2[0]->iva/100)) + ($factura2[0]->subtotal/(1 + ($factura2[0]->iva/100))), 2) }} €</td>
			</tr>
			@endif
		</tfoot>
	</table>

	<p><b>Empresa:</b> Basket VB</p>
	<p><b>Contacto:</b> svitalb04@gmail.com</p>
	<p><b>Teléfono:</b> 669 95 93 17</p>
</body>
</html>