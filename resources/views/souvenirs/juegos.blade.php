@extends("../layout.plantilla_footer")

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
					@include('../layout.plantilla_asideSouvenirs')
				</div>
				<!-- /ASIDE -->

				<div id="store" class="col-md-9">
					{{ $productos->onEachSide(1)->links() }}
					<div class="row">
						@include('flash::message')
						@foreach($productos as $producto)
						<div class="col-md-4 col-xs-6">
							<div class="product">
								<div class="product-img">
									<img src="images/{{ $producto->foto }}" alt="">
								</div>
								<div class="product-body">
									<h3 class="product-name"><a href="{{ route('productosC.show', $producto->id) }}">{{ $producto->nombre }}</a></h3>
									<?php if ((($producto->rebaja_fin) != 0) and (now()->lt(($producto->rebaja_fin)))) { ?>
									<h4 class="product-price">{{ number_format($producto->pvp + ($producto->pvp * ($producto->iva/100)), 2) }} € <del class="product-old-price">{{ number_format(($producto->pvp/(1 - ($producto->rebajado/100))) + (($producto->pvp/(1 - ($producto->rebajado/100))) * ($producto->iva/100)), 2) }} €</del></h4>
									<?php } else { ?>
									<h4 class="product-price">{{ number_format($producto->pvp + ($producto->pvp * ($producto->iva/100)), 2) }} €</h4>
									<?php } ?>
									<div class="product-btns">
										<button type="button" class="quick-view">
											<a href="{{ route('productosC.show', $producto->id) }}">
												<i class="fa fa-eye"></i>
												<span class="tooltipp">Ver</span>
											</a>
										</button>
									</div>
								</div>
								@if(Auth::check())

								@if(($producto->stock_actual) > 10)
								<div class="add-to-cart">
									<button type="submit" class="add-to-cart-btn">
										<a href="{{ route('cart-add', $producto->id) }}">
											<i class="fa fa-shopping-cart"></i>
											Carrito
										</a>
									</button>
								</div>
								@else
								<div class="add-to-cart" style="display:none">
									<button type="submit" class="add-to-cart-btn">
										<a href="">
											<i class="fa fa-shopping-cart"></i>
											Carrito
										</a>
									</button>
								</div>
								@endif

								@endif
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