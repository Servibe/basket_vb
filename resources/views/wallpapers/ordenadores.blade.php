@extends('../layout.plantilla_footer')

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
					{{ $ordenadores->onEachSide(1)->links() }}
					<div class="row">
						@foreach($ordenadores as $producto)
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
					{{ $ordenadores->onEachSide(1)->links() }}
				</div>
			</div>
		</div>
	</div>

	@include('../layout.plantilla_script')

</body>
</html>