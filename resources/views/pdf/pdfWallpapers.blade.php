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
		<center>
			<h3>Listado de Wallpapers</h3>
			<br>
			<table class="table table-striped table-sm table-bordered">
				<thead>
					<tr>
						<th>Nombre</th>
						<th>Descripción</th>
						<th>Talla</th>
						<th>Proveedor</th>
						<th>IVA</th>
						<th>Precio Compra</th>
						<th>PVP</th>
					</tr>
				</thead>

				<tbody>
					@foreach($productos as $producto)

					<tr>
						<td>{{$producto->nombre}}</td>
						<td>{{$producto->descripcion}}</td>
						@if(($producto->talla) != 0)
						<td>{{$producto->talla}}</td>
						@else
						<td>No</td>
						@endif
						<td>{{$producto->proveedor}}</td>
						<td>{{$producto->iva}}</td>
						@if(($producto->precio_compra) != 0)
						<td>{{$producto->precio_compra}}</td>
						@else
						<td>Grátis</td>
						@endif
						@if(($producto->pvp) != 0)
						<td>{{$producto->pvp}}</td>
						@else
						<td>Grátis</td>
						@endif
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