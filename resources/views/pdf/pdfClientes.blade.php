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
			<h3>Listado de Clientes</h3>
			<br>
			<table class="table table-striped table-sm table-bordered">
				<thead>
					<tr>
						<th>Id Usuario</th>
						<th>Username</th>
						<th>Nombre</th>
						<th>Apellidos</th>
						<th>Correo</th>
						<th>Localidad</th>
						<th>Provincia</th>
						<th>Calle</th>
						<th>Código Postal</th>
					</tr>
				</thead>

				<tbody>
					@foreach($clientes as $cliente)

					<tr>
						<td>{{$cliente->user_id}}</td>
						<td>{{$cliente->user->username}}</td>
						<td>{{$cliente->nombre}}</td>
						<td>{{$cliente->apellidos}}</td>
						<td>{{$cliente->user->email}}</td>
						<td>{{$cliente->localidad}}</td>
						<td>{{$cliente->provincia}}</td>
						<td>{{$cliente->calle}}</td>
						<td>{{$cliente->cod_postal}}</td>
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