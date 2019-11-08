@extends("../layout.plantilla_footer")

<!doctype html>

<html>
@include('../layout.plantilla_css')

<body>
	@include('../layout.plantilla_header')
	
	@include('../layout.plantilla_nav')

	<div class="container text-center">
		<b>@include('flash::message')</b>
		<div class="page-header">
			<h1><i class="fa fa-shopping-cart"></i> Carrito</h1>
		</div>

		<div class="table-cart">
			@if(count($cart))

			<p>
				<a href="{{ route('cart-trash') }}" class="btn btn-danger">
					<i class="fa fa-trash"></i>
					Vaciar Carrito
				</a>
			</p>
			<div class="table-responsive">
				<table class="table table-striped table-hover table-bordered">
					<thead>
						<tr>
							<th>Foto</th>
							<th>Nombre</th>
							<th>PVP</th>
							<th>Cantidad</th>
							<th>Subtotal</th>
							<th>Quitar</th>
						</tr>
					</thead>

					<tbody>
						@foreach($cart as $item)
						<tr>
							<td>
								<?php 
								echo '<img src="../../images/'.$item->foto.'" width="100">';
								?>
							</td>
							<td>{{ $item->nombre}}</td>
							<td>{{ number_format($item->pvp + ($item->pvp * ($item->iva/100)), 2) }} €</td>
							<td>
								<input type="number" min="1" max="{{ $item->stock_maximo }}" value="{{ $item->stock_actual }}" id="producto_{{ $item->id }}">
								<a href="" class="btn btn-warning btn-update-item" data-href="{{ route('cart-update', $item->id) }}" data-id="{{ $item->id }}">
									<i class="fa fa-random"></i>
								</a>
							</td>
							<td>{{ number_format(($item->pvp + ($item->pvp * ($item->iva/100))) * $item->stock_actual, 2) }} €</td>
							<td>
								<a href="{{ route('cart-delete', $item->id) }}" class="btn btn-danger">
									<i class="fa fa-trash"></i>
								</a>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table><hr>

				<h3>
					<span class="label label-success">
						Total: {{ number_format($total, 2) }} €
					</span>
				</h3>
			</div>
			@else

			<h3><span class="label label-warning">No hay productos en el carrito</span></h3>

			@endif
			<hr>
			<p>
				<a href="/productosC" class="btn btn-primary">
					<i class="fa fa-chevron-circle-left"></i>
					Seguir Comprando
				</a>
				<a href="{{ route('order-detail') }}" class="btn btn-primary">
					<i class="fa fa-check"></i>
					Continuar
				</a>
			</p>
		</div>
	</div>
	
	@include('../layout.plantilla_script')

</body>
</html>