@extends("../layout.plantilla_footer")

@if(Auth::user()->hasRole('Admin'))

<!doctype html>

<html>
@include('../layout.plantilla_css')

<body>
	@include('../layout.plantilla_header')

	@include('../layout.plantilla_nav')

	<!-- SECTION -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<span class="ir-arriba"><i class="fa fa-angle-double-up"></i></span>
			<!-- row -->
			<div class="row">
				@include('../layout.plantilla_aside')

				<div class="table-responsive text-nowrap">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>Nombre</th>
								<th>Descripción</th>
								<th>Talla</th>
								<th>Equipo</th>
								<th>Marca</th>
								<th>PVP</th>
								<th>Stock Actual</th>
								<th>Foto</th>
							</tr>
						</thead>

						<tbody>
							@foreach($productos as $producto)
							<tr>
								<td><a href="{{route('productos.edit', $producto->id)}}">{{$producto->nombre}}</a></td>
								<td>{{$producto->descripcion}}</td>
								<td>{{$producto->talla}}</td>
								<td>{{$producto->equipo}}</td>
								<td>{{$producto->proveedor}}</td>
								<td>{{$producto->pvp}}</td>
								<td>{{$producto->stock_actual}}</td>
								<td><img src="images/{{$producto->foto}}" alt="" width="100"></td>
							</tr>
							@endforeach
						</tbody>
					</table>
					{{ $productos->onEachSide(1)->links() }}
				</div>
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /SECTION -->

	<center>
		<button type="button" class="btn btn-outline-primary">
			<a href="{{route('imprimirWallpapers')}}">
				Imprimir
			</a>
		</button>
	</center><br>

	@include('../layout.plantilla_script')

</body>
</html>

@else

<!doctype html>

<html>
@include('../layout.plantilla_css')

<body>
	@include('../layout.plantilla_header')

	@include('../layout.plantilla_nav')

	<!-- SECTION -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<span class="ir-arriba"><i class="fa fa-angle-double-up"></i></span>
			<!-- row -->
			<div class="row">
				<!-- ASIDE -->
				<div id="aside" class="col-md-3">
					<!-- aside Widget -->
					@include('../layout.plantilla_asideWallpapers')
				</div>
				<!-- /aside Widget -->

				<div id="store" class="col-md-9">
					{{ $productos->onEachSide(1)->links() }}
					<div class="row">
						@foreach($productos as $producto)
						<div class="col-md-4 col-xs-6">
							<div class="product">
								<div class="product-img">
									<img src="images/{{ $producto->foto }}" alt="">
								</div>
								<div class="product-body">
									<h3 class="product-name"><a href="{{ route('productosC.show', $producto->id) }}">{{ $producto->nombre }}</a></h3>
									@if(($producto->tipo_producto) == 17)
									<h4 class="product-price">{{ 'Gratis' }}</h4>
									@endif
									<div class="product-btns">
										<button type="button" class="quick_view">
											<a href="{{ route('comprimirWallpapers', 'foto='.$producto->foto) }}">
												<i class="fa fa-download"></i>
												<span class="tooltipp">Descargar</span>
											</a>
										</button>
									</div>
								</div>
							</div>
						</div>
						@endforeach
					</div><br><br>
					{{ $productos->onEachSide(1)->links() }}
				</div>
			</div>
		</div>
	</div>


	@include('../layout.plantilla_script')

</body>
</html>

@endif