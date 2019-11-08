@extends("../layout.plantilla_footer")

<!doctype html>

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
							<a href="/home">
								<img src="/images/Logo/Logo.png" alt="" width="100">
							</a>
						</div>
					</div>
					<!-- /LOGO -->

					<!-- SEARCH BAR -->
					<div class="col-md-6">
						<div class="header-search">
							{!! Form::open(['url' => '/balones', 'method' => 'get', 'role' => 'search']) !!}
							{!! Form::hidden(null, csrf_token()) !!}
							{!! Form::text('equipo', null, ['class' => 'input', 'placeholder' => 'Equipo']) !!}
							<button type="submit" class="search-btn">Search</button>
							{!! Form::close() !!}
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
			<span class="ir-arriba"><i class="fa fa-angle-double-up"></i></span>
			<!-- row -->
			<div class="row">
				<!-- ASIDE -->
				<div id="aside" class="col-md-3">
					<!-- aside Widget -->
					@include('../layout.plantilla_asideSouvenirs')

					<div class="aside">
						<h3 class="aside-title">Tallas</h3>
						{!! Form::open(['url' => '/balones', 'method' => 'get']) !!}
						<div class="checkbox-filter">
							<div>
								{!! Form::checkbox('talla', '7', false) !!}
								<label style="font-weight: normal;">
									<span></span>
									Talla 7
									<small>(<?php $talla = App\Producto::where('talla', '7')->where('tipo_producto', 2)->count(); echo $talla; ?>)</small>
								</label>
							</div>
							<br>
							<button type="submit" class="btn btn-secondary">
								Filtrar
							</button>
						</div>
						{!! Form::close() !!}
					</div>

					<!-- /aside Widget -->
					<div class="aside">
						<h3 class="aside-title">Equipos</h3>
						<div>
							<div>
								<label>
									<a href="/ocultoBalones">
										<img src="/images/Logo/equipos/NBA.png" alt="" width="15">
										<span></span>
										Todos
										<small>(<?php $categoria = \DB::table('productos')->where('tipo_producto', 2)->count(); echo $categoria; ?>)</small>
									</a>
								</label>
							</div>
							<hr>
							<div>
								<label>
									<a href="/balones?equipo=celtics">
										<img src="/images/Logo/equipos/Celtics.png" alt="" width="30">
										<span></span>
										Celtics
										<small>(<?php $categoria = \DB::table('productos')->where('equipo', 'celtics')->where('tipo_producto', 2)->count(); echo $categoria; ?>)</small>
									</a>
								</label>
							</div>
							<div>
								<label>
									<a href="/balones?equipo=nets">
										<img src="/images/Logo/equipos/Nets.png" alt="" width="30">
										<span></span>
										Nets
										<small>(<?php $categoria = \DB::table('productos')->where('equipo', 'nets')->where('tipo_producto', 2)->count(); echo $categoria; ?>)</small>
									</a>
								</label>
							</div>
							<div>
								<label>
									<a href="/balones?equipo=knicks">
										<img src="/images/Logo/equipos/Knicks.png" alt="" width="30">
										<span></span>
										Knicks
										<small>(<?php $categoria = \DB::table('productos')->where('equipo', 'knicks')->where('tipo_producto', 2)->count(); echo $categoria; ?>)</small>
									</a>
								</label>
							</div>
							<div>
								<label>
									<a href="/balones?equipo=sixers">
										<img src="/images/Logo/equipos/Sixers.png" alt="" width="30">
										<span></span>
										Sixers
										<small>(<?php $categoria = \DB::table('productos')->where('equipo', 'sixers')->where('tipo_producto', 2)->count(); echo $categoria; ?>)</small>
									</a>
								</label>
							</div>
							<div>
								<label>
									<a href="/balones?equipo=raptors">
										<img src="/images/Logo/equipos/Raptors.png" alt="" width="30">
										<span></span>
										Raptors
										<small>(<?php $categoria = \DB::table('productos')->where('equipo', 'raptors')->where('tipo_producto', 2)->count(); echo $categoria; ?>)</small>
									</a>
								</label>
							</div>
							<div>
								<label>
									<a href="/balones?equipo=bulls">
										<img src="/images/Logo/equipos/Bulls.png" alt="" width="30">
										<span></span>
										Bulls
										<small>(<?php $categoria = \DB::table('productos')->where('equipo', 'bulls')->where('tipo_producto', 2)->count(); echo $categoria; ?>)</small>
									</a>
								</label>
							</div>
							<div>
								<label>
									<a href="/balones?equipo=cavaliers">
										<img src="/images/Logo/equipos/Cavaliers.png" alt="" width="30">
										<span></span>
										Cavaliers
										<small>(<?php $categoria = \DB::table('productos')->where('equipo', 'cavaliers')->where('tipo_producto', 2)->count(); echo $categoria; ?>)</small>
									</a>
								</label>
							</div>
							<div>
								<label>
									<a href="/balones?equipo=pistons">
										<img src="/images/Logo/equipos/Pistons.png" alt="" width="30">
										<span></span>
										Pistons
										<small>(<?php $categoria = \DB::table('productos')->where('equipo', 'pistons')->where('tipo_producto', 2)->count(); echo $categoria; ?>)</small>
									</a>
								</label>
							</div>
							<div>
								<label>
									<a href="/balones?equipo=pacers">
										<img src="/images/Logo/equipos/Pacers.png" alt="" width="30">
										<span></span>
										Pacers
										<small>(<?php $categoria = \DB::table('productos')->where('equipo', 'pacers')->where('tipo_producto', 2)->count(); echo $categoria; ?>)</small>
									</a>
								</label>
							</div>
							<div>
								<label>
									<a href="/balones?equipo=bucks">
										<img src="/images/Logo/equipos/Bucks.png" alt="" width="30">
										<span></span>
										Bucks
										<small>(<?php $categoria = \DB::table('productos')->where('equipo', 'bucks')->where('tipo_producto', 2)->count(); echo $categoria; ?>)</small>
									</a>
								</label>
							</div>
							<div>
								<label>
									<a href="/balones?equipo=nuggets">
										<img src="/images/Logo/equipos/Nuggets.png" alt="" width="30">
										<span></span>
										Nuggets
										<small>(<?php $categoria = \DB::table('productos')->where('equipo', 'nuggets')->where('tipo_producto', 2)->count(); echo $categoria; ?>)</small>
									</a>
								</label>
							</div>
							<div>
								<label>
									<a href="/balones?equipo=timberwolves">
										<img src="/images/Logo/equipos/Timberwolves.png" alt="" width="30">
										<span></span>
										Timberwolves
										<small>(<?php $categoria = \DB::table('productos')->where('equipo', 'timberwolves')->where('tipo_producto', 2)->count(); echo $categoria; ?>)</small>
									</a>
								</label>
							</div>
							<div>
								<label>
									<a href="/balones?equipo=thunder">
										<img src="/images/Logo/equipos/Thunder.png" alt="" width="30">
										<span></span>
										Thunder
										<small>(<?php $categoria = \DB::table('productos')->where('equipo', 'thunder')->where('tipo_producto', 2)->count(); echo $categoria; ?>)</small>
									</a>
								</label>
							</div>
							<div>
								<label>
									<a href="/balones?equipo=trail blazers">
										<img src="/images/Logo/equipos/Trail Blazers.png" alt="" width="30">
										<span></span>
										Trail Blazers
										<small>(<?php $categoria = \DB::table('productos')->where('equipo', 'trail blazers')->where('tipo_producto', 2)->count(); echo $categoria; ?>)</small>
									</a>
								</label>
							</div>
							<div>
								<label>
									<a href="/balones?equipo=jazz">
										<img src="/images/Logo/equipos/Jazz.png" alt="" width="30">
										<span></span>
										Jazz
										<small>(<?php $categoria = \DB::table('productos')->where('equipo', 'jazz')->where('tipo_producto', 2)->count(); echo $categoria; ?>)</small>
									</a>
								</label>
							</div>
							<div>
								<label>
									<a href="/balones?equipo=warriors">
										<img src="/images/Logo/equipos/Warriors.png" alt="" width="30">
										<span></span>
										Warriors
										<small>(<?php $categoria = \DB::table('productos')->where('equipo', 'warriors')->where('tipo_producto', 2)->count(); echo $categoria; ?>)</small>
									</a>
								</label>
							</div>
							<div>
								<label>
									<a href="/balones?equipo=clippers">
										<img src="/images/Logo/equipos/Clippers.png" alt="" width="30">
										<span></span>
										Clippers
										<small>(<?php $categoria = \DB::table('productos')->where('equipo', 'clippers')->where('tipo_producto', 2)->count(); echo $categoria; ?>)</small>
									</a>
								</label>
							</div>
							<div>
								<label>
									<a href="/balones?equipo=lakers">
										<img src="/images/Logo/equipos/Lakers.png" alt="" width="30">
										<span></span>
										Lakers
										<small>(<?php $categoria = \DB::table('productos')->where('equipo', 'lakers')->where('tipo_producto', 2)->count(); echo $categoria; ?>)</small>
									</a>
								</label>
							</div>
							<div>
								<label>
									<a href="/balones?equipo=suns">
										<img src="/images/Logo/equipos/Suns.png" alt="" width="30">
										<span></span>
										Suns
										<small>(<?php $categoria = \DB::table('productos')->where('equipo', 'suns')->where('tipo_producto', 2)->count(); echo $categoria; ?>)</small>
									</a>
								</label>
							</div>
							<div>
								<label>
									<a href="/balones?equipo=kings">
										<img src="/images/Logo/equipos/Kings.png" alt="" width="30">
										<span></span>
										Kings
										<small>(<?php $categoria = \DB::table('productos')->where('equipo', 'kings')->where('tipo_producto', 2)->count(); echo $categoria; ?>)</small>
									</a>
								</label>
							</div>
							<div>
								<label>
									<a href="/balones?equipo=hawks">
										<img src="/images/Logo/equipos/Hawks.png" alt="" width="30">
										<span></span>
										Hawks
										<small>(<?php $categoria = \DB::table('productos')->where('equipo', 'hawks')->where('tipo_producto', 2)->count(); echo $categoria; ?>)</small>
									</a>
								</label>
							</div>
							<div>
								<label>
									<a href="/balones?equipo=hornets">
										<img src="/images/Logo/equipos/Hornets.png" alt="" width="30">
										<span></span>
										Hornets
										<small>(<?php $categoria = \DB::table('productos')->where('equipo', 'hornets')->where('tipo_producto', 2)->count(); echo $categoria; ?>)</small>
									</a>
								</label>
							</div>
							<div>
								<label>
									<a href="/balones?equipo=heat">
										<img src="/images/Logo/equipos/Heat.png" alt="" width="30">
										<span></span>
										Heat
										<small>(<?php $categoria = \DB::table('productos')->where('equipo', 'heat')->where('tipo_producto', 2)->count(); echo $categoria; ?>)</small>
									</a>
								</label>
							</div>
							<div>
								<label>
									<a href="/balones?equipo=magic">
										<img src="/images/Logo/equipos/Magic.png" alt="" width="30">
										<span></span>
										Magic
										<small>(<?php $categoria = \DB::table('productos')->where('equipo', 'magic')->where('tipo_producto', 2)->count(); echo $categoria; ?>)</small>
									</a>
								</label>
							</div>
							<div>
								<label>
									<a href="/balones?equipo=wizards">
										<img src="/images/Logo/equipos/Wizards.png" alt="" width="30">
										<span></span>
										Wizards
										<small>(<?php $categoria = \DB::table('productos')->where('equipo', 'wizards')->where('tipo_producto', 2)->count(); echo $categoria; ?>)</small>
									</a>
								</label>
							</div>
							<div>
								<label>
									<a href="/balones?equipo=mavericks">
										<img src="/images/Logo/equipos/Mavericks.png" alt="" width="30">
										<span></span>
										Mavericks
										<small>(<?php $categoria = \DB::table('productos')->where('equipo', 'mavericks')->where('tipo_producto', 2)->count(); echo $categoria; ?>)</small>
									</a>
								</label>
							</div>
							<div>
								<label>
									<a href="/balones?equipo=rockets">
										<img src="/images/Logo/equipos/Rockets.png" alt="" width="30">
										<span></span>
										Rockets
										<small>(<?php $categoria = \DB::table('productos')->where('equipo', 'rockets')->where('tipo_producto', 2)->count(); echo $categoria; ?>)</small>
									</a>
								</label>
							</div>
							<div>
								<label>
									<a href="/balones?equipo=grizzlies">
										<img src="/images/Logo/equipos/Grizzlies.png" alt="" width="30">
										<span></span>
										Grizzlies
										<small>(<?php $categoria = \DB::table('productos')->where('equipo', 'grizzlies')->where('tipo_producto', 2)->count(); echo $categoria; ?>)</small>
									</a>
								</label>
							</div>
							<div>
								<label>
									<a href="/balones?equipo=pelicans">
										<img src="/images/Logo/equipos/Pelicans.png" alt="" width="30">
										<span></span>
										Pelicans
										<small>(<?php $categoria = \DB::table('productos')->where('equipo', 'pelicans')->where('tipo_producto', 2)->count(); echo $categoria; ?>)</small>
									</a>
								</label>
							</div>
							<div>
								<label>
									<a href="/balones?equipo=spurs">
										<img src="/images/Logo/equipos/Spurs.png" alt="" width="30">
										<span></span>
										Spurs
										<small>(<?php $categoria = \DB::table('productos')->where('equipo', 'spurs')->where('tipo_producto', 2)->count(); echo $categoria; ?>)</small>
									</a>
								</label>
							</div>
						</div>
					</div>
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
									<p class="product-category">{{ $producto->equipo }}</p>
									<h3 class="product-name"><a href="{{ route('productosC.show', $producto->id) }}">{{ $producto->nombre }}</a></h3>
									<h5>Talla: {{ $producto->talla }}</h5>
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