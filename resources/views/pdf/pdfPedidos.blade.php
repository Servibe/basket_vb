<!DOCTYPE html>

<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

	<style type="text/css">
	* { 
		margin: 0; 
		padding: 0; 
	}
	body { 
		font: 16px/1.4 Georgia, Serif; 
	}
	#page-wrap {
		margin: 50px;
	}
	p {
		margin: 20px 0; 
	}

	/* 
	Generic Styling, for Desktops/Laptops 
	*/
	table { 
		width: 100%; 
		border-collapse: collapse; 
	}
	/* Zebra striping */
	tr:nth-of-type(odd) { 
		background: #eee; 
	}
	th { 
		background: #333; 
		color: white; 
		font-weight: bold; 
	}
	td, th { 
		padding: 6px; 
		border: 1px solid #ccc; 
		text-align: left; 
	}
	</style>
</head>

<body>
	<header>
		<img src="{{ asset('/images/Logo/Logo PDF.png') }}">
		<center>
			<h1><strong>BASKET VB</strong></h1>
		</center>
	</header>

	<hr>

	<div id="page-wrap" class="table-responsive text-nowrap">
		<h3>Listado de Pedidos</h3>
		<br>
		<center>
			<table class="table table-striped table-sm table-bordered">
				<thead>
					<tr>
						<th>Num Pedido</th>
						<th>Id Cliente</th>
						<th>Subtotal</th>
						<th>Coste Envio</th>
						<th>Factura</th>
						<th>Unidades</th>
						<th>Precio</th>
						<th>Producto</th>
						<th>Fecha Pedido</th>
						<th>Fecha Envio</th>
						<th>Fecha Entrega</th>
						<th>Método de Pago</th>
					</tr>
				</thead>

				<tbody>
					@foreach($pedidos as $pedido)

					<tr>
						<td>{{$pedido->id}}</td>
						<td>{{$pedido->user_id}}</td>
						<td>{{$pedido->subtotal}}</td>
						<td>{{$pedido->envio}}</td>
						@if(($pedido->factura_id) != 0)
						<td>{{$pedido->factura_id}}</td>
						@else
						<td>Sin registro de la factura</td>
						@endif
						@if(($pedido->factura_id) != 0)
						<td><i class="fa fa-check"></i></td>
						@else
						<td><i class="fa fa-times"></i></td>
						@endif
						<td>{{$pedido->pedido_items[0]->unidades}}</td>
						<td>{{$pedido->pedido_items[0]->precio}}</td>
						<td>{{$pedido->fecha_pedido}}</td>
						<td>{{$pedido->fecha_envio}}</td>
						<td>{{$pedido->fecha_entrega}}</td>
						<td>{{$pedido->metodo_pago}}</td>
					</tr>

					@endforeach
				</tbody>
			</table>
		</center>
	</div>

	<b>Empresa:</b> Basket VB
	<b>Contacto:</b> svitalb02@gmail.com
	<b>Teléfono:</b> 669 95 93 17
</body>
</html>