@extends("../layout.plantilla_footer")

<!DOCTYPE html>

<html>
@include('../layout.plantilla_css')

<body>
	<header>
		<!-- MAIN HEADER -->
		<div id="header">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<!-- LOGO -->
					<div class="col-md-3">
						<div class="header-logo">
							@if(Auth::check())
							<a href="/home">
								<img src="/images/Logo/Logo.png" alt="" width="100">
							</a>
							@else
							<a href="/">
								<img src="/images/Logo/Logo.png" alt="" width="100">
							</a>
							@endif
						</div>
					</div>
					<!-- /LOGO -->

					<!-- SEARCH BAR -->
					<div class="col-md-6">
						<div class="header-search">
							<center>
								<h1 style="color:#FDFEFE">
									BASKET VB
								</h1>
							</center>
						</div>
					</div>
					<!-- /SEARCH BAR -->

					<!-- ACCOUNT -->
					<div class="col-md-3 clearfix">
						<div class="header-ctn">
							@if(Auth::check())
							<!-- Cart -->
							<div class="dropdown">
								<a class="dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="true">
									<i class="fa fa-shopping-cart"></i>
									<span>Carrito</span>
									@if(Session::get('cart') == 0)
									<div class="qty">0</div>
									@else
									<div class="qty">{{ count(Session::get('cart')) }}</div>
									@endif
								</a>
								<div class="cart-dropdown">
									@if(Session::get('cart') != 0)
									<div class="cart-list">
										<?php $total = 0; ?>
										@forelse(Session::get('cart') as $item)
										<div class="product-widget">
											<div class="product-img">
												<img src="/images/{{$item->foto}}" alt="">
											</div>
											<div class="product-body">
												<h3 class="product-name">{{ $item->nombre }}</h3>
												<h4 class="product-price">
													<span class="qty">{{ $item->stock_actual }} (u)</span>
													{{ number_format(($item->pvp + ($item->pvp * ($item->iva/100))) * $item->stock_actual, 2) }} €
												</h4>
												<?php
												$total += ($item->pvp + ($item->pvp * ($item->iva/100))) * $item->stock_actual;
												?>
											</div>
											<button class="delete">
												<a href="{{ route('cart-delete', $item->id) }}">
													<i class="fa fa-close" style="color:#FDFEFE"></i>
												</a>
											</button>
										</div>
										@empty
										<div>
											<h3>Carrito Vacio</h3>
										</div>
										@endforelse
									</div>
									<div class="cart-summary">
										@if(Session::get('cart') == 0)
										<small>0 Productos seleccionados</small>
										@else
										<small>{{ count(Session::get('cart')) }} Producto(s) seleccionados</small>
										<h5>Subtotal: {{ number_format($total, 2) }} €</h5>
										@endif
									</div>
									@else
									<div>
										<h3>Carrito Vacio</h3>
									</div>
									@endif
									<div class="cart-btns">
										<a href="{{ route('cart-show') }}">Ver Carrito</a>
										<a href="{{ route('order-detail') }}">
											<i class="fa fa-arrow-circle-right"></i>
											Detalles
										</a>
									</div>
								</div>
							</div>
							<!-- /Cart -->
							@endif
							<!-- Menu Toogle -->
							<div class="menu-toggle">
								<a href="#">
									<i class="fa fa-bars"></i>
									<span>Menu</span>
								</a>
							</div>
							<!-- /Menu Toogle -->
						</div>

						<div class="header-ctn">
							<!-- Authentication Links -->
							@guest
							<a href="{{ route('login') }}" style="color:#FDFEFE">{{ __('Login') }}</a> |
							@if (Route::has('register'))
							<a href="{{ route('register') }}" style="color:#FDFEFE">{{ __('Register') }}</a>
							@endif
							@else
							<div class="dropdown">
								<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" style="color:#FDFEFE" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
									<i class="fa fa-user"></i> {{ Auth::user()->username }} <span class="caret"></span>
								</a>

								<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
									<li><a class="dropdown-item" href="{{route('usuarios.show', Auth::user()->id)}}">Perfil</a></li>
									<li><a class="dropdown-item" href="/mis_pedidos">Mis Pedidos</a></li>
									<li><a class="dropdown-item" href="{{ route('logout') }}"
										onclick="event.preventDefault();
										document.getElementById('logout-form').submit();">
										{{ __('Logout') }}
									</a></li>

									<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
										@csrf
									</form>
								</div>
							</div>
							@endguest
						</div>
					</div>
					<!-- /ACCOUNT -->
				</div>
				<!-- row -->
			</div>
			<!-- container -->
		</div>
		<!-- /MAIN HEADER -->
	</header>

	@include('../layout.plantilla_nav')

	<!-- SECTION -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				@include('flash::message')
				@if($producto->rebaja_fin == now()->toDateString())
				<div class="alert alert-info">
					<p><strong>Fin de la rebaja.</strong>Lo sentimos, recargue la página.</p>
				</div>
				@endif
				<!-- Product main img -->
				<div class="col-md-5 col-md-push-2">
					<div id="product-main-img">
						<div class="product-preview">
							<img src="/images/{{ $producto->foto }}" alt="">
						</div>
					</div>
				</div>
				<!-- /Product main img -->

				<!-- Product thumb imgs -->
				<div class="col-md-2  col-md-pull-5">

				</div>
				<!-- /Product thumb imgs -->

				<!-- Product details -->
				<div class="col-md-5">
					<div class="product-details">
						<h2 class="product-name">{{ $producto->nombre }}</h2>
						<div>
							@if(($producto->tipo_producto) != 17)
							<?php if ((($producto->rebaja_fin) != 0) and (now()->lt(($producto->rebaja_fin)))) { ?>
							<h4 class="product-price">{{ number_format($producto->pvp + ($producto->pvp * ($producto->iva/100)), 2) }} € <del class="product-old-price">{{ number_format(($producto->pvp/(1 - ($producto->rebajado/100))) + (($producto->pvp/(1 - ($producto->rebajado/100))) * ($producto->iva/100)), 2) }} €</del></h4>
							<?php } else { ?>
							<h4 class="product-price">{{ number_format($producto->pvp + ($producto->pvp * ($producto->iva/100)), 2) }} €</h4>
							<?php } ?>
							@else
							<h3 class="product-price">{{ 'Gratis' }}</h3>
							@endif
							@if(($producto->stock_actual) > 10)
							<span class="product-available">En Stock</span>
							@else
							<span class="product-available">Fuera de Stock</span>
							@endif
						</div>
						@if(Auth::check())

						@if((($producto->stock_actual) > 10) and ($producto->tipo_producto) != 17)
						<div class="add-to-cart">
							<button class="add-to-cart-btn">
								<a href="{{ route('cart-add', $producto->id) }}">
									<i class="fa fa-shopping-cart"></i> 
									Carrito
								</a>
							</button>
						</div>
						@elseif (($producto->tipo_producto) == 17)
						<div>
							<button type="button" class="btn btn-download">
								<a href="{{route('comprimir', 'foto='.$producto->foto)}}">
									<i class="fa fa-download"></i>
									<span class="tooltipp">Descargar</span>
								</a>
							</button>
						</div>
						@endif

						@else
						@if(($producto->tipo_producto) == 17)
						<div>
							<button type="button" class="btn btn-download">
								<a href="{{route('comprimir', 'foto='.$producto->foto)}}">
									<i class="fa fa-download"></i>
									<span class="tooltipp">Descargar</span>
								</a>
							</button>
						</div>
						@endif

						@endif
						<ul class="product-links">
							<li style="font-weight: bold;">Stock:</li>
							<li>{{ $producto->stock_actual }}</li>
							<li style="font-weight: bold;">Marca:</li>
							<li>{{ $producto->proveedor }}</li>
							@if(($producto->rebajado) != 0)
							<li style="font-weight: bold;">Rebaja:</li>
							<li>- {{ number_format($producto->rebajado, 0) }}%</li>
							@endif
							@if(($producto->tipo_producto) == 9)
							<li style="font-weight: bold;">Móvil:</li>
							<li>
								<select class="rounded">
									<option>Android</option>
									<option>iPhone</option>
								</select>
							</li>
							@endif
						</ul>
						<br>
						<div>
							<label class="form-group">Descripción:</label>
							<div>{{ $producto->descripcion }}</div>
						</div>
					</div>
				</div>
				<!-- /Product details -->
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /SECTION -->

	<center>
		<div class="form-group row">
			<div class="col-sm-10">
				@if(Auth::check())
				@if((($producto->tipo_producto) == 1) or (($producto->tipo_producto) == 4) or (($producto->tipo_producto) == 5) or (($producto->tipo_producto) == 8))
				<button type="button" class="btn btn-outline-primary"><a href="/ocultoVolverAccesorios">Volver a Menú Accesorios</a></button>
				@elseif(($producto->tipo_producto) == 18)
				<button type="button" class="btn btn-outline-primary"><a href="/ocultoVolverCalzado">Volver a Menú Calzado</a></button>
				@elseif((($producto->tipo_producto) == 6) or (($producto->tipo_producto) == 7) or (($producto->tipo_producto) == 13) or (($producto->tipo_producto) == 15))
				<button type="button" class="btn btn-outline-primary"><a href="/ocultoVolverConfeccion">Volver a Menú Confección</a></button>
				@elseif((($producto->tipo_producto) == 2) or (($producto->tipo_producto) == 3) or (($producto->tipo_producto) == 9) or (($producto->tipo_producto) == 10) or (($producto->tipo_producto) == 11) or (($producto->tipo_producto) == 12) or (($producto->tipo_producto) == 14) or (($producto->tipo_producto) == 16))
				<button type="button" class="btn btn-outline-primary"><a href="/ocultoVolverSouvenirs">Volver a Menú Souvenirs</a></button>
				@elseif(($producto->tipo_producto) == 17)
				<button type="button" class="btn btn-outline-primary"><a href="/wallpapers">Volver a Menú Wallpapers</a></button>
				@endif
				@else
				<button type="button" class="btn btn-outline-primary"><a href="/ocultoVolver">Volver a Menú</a></button>
				@endif
			</div>
		</div>
	</center>

	@include('../layout.plantilla_script')

</body>
</html>