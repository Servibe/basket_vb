@extends("../layout.plantilla_footer")

<!doctype html>

<html>
@include('../layout.plantilla_css')

<body>
	<!-- HEADER -->
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
							<a href="/home">
								<img src="/images/Logo/Logo.png" alt="" width="100">
							</a>
						</div>
					</div>
					<!-- /LOGO -->

					<!-- SEARCH BAR -->
					<div class="col-md-6">
						<div class="header-search">
							<center>
								{!! Form::open(['url' => '/mis_pedidos', 'method' => 'get', 'role' => 'search']) !!}
								{!! Form::hidden(null, csrf_token()) !!}
								{!! Form::date('fecha_pedido', null, ['class' => 'input']) !!}
								<button type="submit" class="search-btn">Search</button>
								<p></p>
								{{ Form::open(['url' => '/mis_pedidos', 'method' => 'get', 'role' => 'search']) }}
								{{ Form::date('fecha_pedido2', null, ['class' => 'input']) }}
								<button type="submit" class="search-btn">Search</button>
								{!! Form::close() !!}
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
	<!-- /HEADER -->
	
	@include('../layout.plantilla_nav')

	<!-- SECTION -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				@include('flash::message')

				<div class="table-responsive text-nowrap">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>Pedido</th>
								<th>Id Cliente</th>
								<th>Subtotal</th>
								<th>Coste Envio</th>
								<th>Factura</th>
								<th>Precio</th>
								<th>F. Pedido</th>
							</tr>
						</thead>

						<tbody>
							@foreach($pedidos as $pedido)
							<tr>
								<td><a href="{{route('pedidos.show', $pedido->id)}}">{{$pedido->id}}</a></td>
								<td>{{$pedido->user_id}}</td>
								<td>{{$pedido->subtotal}}</td>
								<td>{{$pedido->envio}}</td>
								@if(($pedido->factura_id) != 0)
								<td>
									<a href="{{ route('verFactura', $pedido->id) }}" target="_blank">
										<i class="fa fa-check"></i>
									</a>
								</td>
								@else
								<td>
									<a href="{{ route('imprimirFactura', $pedido->id) }}" onclick="reload(3);">
										<i class="fa fa-times"></i>
									</a>
								</td>
								@endif
								<td>{{$pedido->pedido_items[0]->precio}}</td>
								<td>{{$pedido->fecha_pedido}}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
					{{ $pedidos->onEachSide(1)->links() }}
				</div>
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /SECTION -->

	<center>
		<div class="form-group row">
			<div class="col-sm-10">
				<button type="button" class="btn btn-outline-primary"><a href="/home">Inicio</a></button>
			</div>
		</div>
	</center>

	@include('../layout.plantilla_script')

	<script>
	function reload(segs) {
		setTimeout(function() {
			location.reload();
		}, parseInt(segs) * 1000);
	}
	</script>

</body>
</html>