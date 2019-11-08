@extends("../layout.plantilla_footer")

<!doctype html>

<html>
@include('../layout.plantilla_css')

<body>
	@include('../layout.plantilla_header')

	@include('../layout.plantilla_nav')

	<div class="section">
		<div class="container">
			<div class="row">
				@include('flash::message')
				<div class="container text-center">
					<div class="page-header">
						<h1><i class="fa fa-shopping-cart"></i> Detalles del pedido</h1>
					</div>

					<div class="page">
						<div class="table-responsive">
							<h3>Datos del usuario</h3>
							<table class="table table-striped table-hover table-bordered">
								<tr><td>Nombre:</td><td>{{ Auth::user()->cliente->nombre . " " . Auth::user()->cliente->apellidos }}</td></tr>
								<tr><td>Usuario:</td><td>{{ Auth::user()->username }}</td></tr>
								<tr><td>Correo:</td><td>{{ Auth::user()->email }}</td></tr>
								<tr><td>Código Postal:</td><td>{{ Auth::user()->cliente->cod_postal }}</td></tr>
							</table>
						</div>
						<div class="table-responsive">
							<table class="table table-striped table-hover table-bordered">
								<tr>
									<td>Nombre</td>
									<td>PVP</td>
									<td>Cantidad</td>
									<td>Subtotal</td>
								</tr>

								@foreach($cart as $item)
								<tr>
									<td>{{ $item->nombre }}</td>
									<td>{{ number_format($item->pvp + ($item->pvp * ($item->iva/100)), 2) }}€</td>
									<td>{{ $item->stock_actual }}</td>
									<td>{{ number_format(($item->pvp + ($item->pvp * ($item->iva/100))) * $item->stock_actual, 2) }}€</td>
								</tr>
								@endforeach
							</table>

							<hr>

							<h3>
								<span class="label label-success">
									Total: {{ number_format($total, 2) }} €
								</span>
							</h3>

							<hr>

							<p>
								<a href="{{ route('cart-show') }}" class="btn btn-primary">
									<i class="fa fa-chevron-circle-left"></i>
									Volver
								</a>

								<a href="{{ route('payment') }}" class="btn btn-primary">
									<i class="fa fa-credit-card"></i>
									Pagar
								</a>
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	@include('../layout.plantilla_script')


</body>
</html>