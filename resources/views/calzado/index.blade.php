@extends("../layout.plantilla_footer")

@if(Auth::user()->hasRole('Admin'))

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
							{!! Form::open(['url' => '/calzado', 'method' => 'get', 'role' => 'search']) !!}
							{!! Form::hidden(null, csrf_token()) !!}
							<?php
							$proveedores = \DB::table('proveedors')
							->join('productos', 'proveedors.nombre', '=', 'productos.proveedor')
							->select('proveedors.nombre')->where('productos.tipo_producto', 18)
							->orderBy('nombre')->pluck('nombre', 'nombre');
							?>
							{!! Form::select('proveedor', $proveedores, null, ['class' => 'input']) !!}
							<button type="submit" class="search-btn">Search</button>
							{!! Form::close() !!}
						</div>
					</div>
					<!-- /SEARCH BAR -->

					<!-- ACCOUNT -->
					<div class="col-md-3 clearfix">
						<div class="header-ctn">
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
							<?php
							$count = 0;
							?>
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
								@if(($producto->rebajado) == 0)
								<td>
									<center>
										<button class="btn btn-success" data-toggle="modal" id="{{ $producto->id }}" data-target="#descuento<?php echo $count; ?>">
											Rebajar
										</button>
										<div id="descuento<?php echo $count; ?>" class="modal modal-success fade" tableindex="-1" role="dialog" aria-labelledby="myModalLabel">
											<div class="modal-dialog" role="document">
												<div class="modal-content">
													{!! Form::model($producto, ['method' => 'post', 'action' => ['ProductosController@rebajas', $producto->id]]) !!}
													{{ csrf_field() }}
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															<span aria-hidden="true">&times;</span>
														</button>
														<h2 class="modal-title text-center" id="myModalLabel">Descontar</h2>
													</div>
													<div class="modal-body">
														<p class="text-center">Aplicar descuento de:</p>
														<center>
															<select name="rebajado" class="rounded">
																<option value="5">5</option>
																<option value="10">10</option>
																<option value="20">20</option>
																<option value="30">30</option>
																<option value="40">40</option>
																<option value="50">50</option>
																<option value="75">75</option>
																<option value="80">80</option>
															</select> %
															&nbsp;&nbsp;&nbsp;
															<select name="tiempo" class="rounded">
																<option value="1">1</option>
																<option value="2">2</option>
																<option value="5">5</option>
																<option value="7">7</option>
															</select> día/s
														</center>
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-danger" data-dismiss="modal">
															Cancelar
														</button>
														<button type="submit" class="btn btn-success">
															Aceptar
														</button>
													</div>
													{!! Form::close() !!}
												</div>
											</div>
										</div>
									</center>
								</td>
								@else
								<td>
									<center>
										{!! Form::model($producto, ['method' => 'post', 'action' => ['ProductosController@normal', $producto->id]]) !!}
										{!! Form::submit('Quitar rebaja', ['class' => 'btn btn-danger']) !!}
										{!! Form::close() !!}
									</center>
								</td>
								@endif
							</tr>
							<?php
							$count++;
							?>
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
			<a href="{{route('imprimirCalzado')}}">
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
							{!! Form::open(['url' => '/calzado', 'method' => 'get', 'role' => 'search']) !!}
							{!! Form::hidden(null, csrf_token()) !!}
							{!! Form::text('marca', null, ['class' => 'input', 'placeholder' => 'Marca']) !!}
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
					@include('../layout.plantilla_asideCalzado')

					<div class="aside">
						<h3 class="aside-title">Tallas</h3>
						{!! Form::open(['url' => '/calzado', 'method' => 'get']) !!}
						<div class="checkbox-filter">
							<div>
								{!! Form::checkbox('talla', '41', false) !!}
								<label style="font-weight: normal;">
									<span></span>
									Talla 41
									<small>(<?php $talla = App\Producto::where('talla', '41')->where('tipo_producto', 18)->count(); echo $talla; ?>)</small>
								</label>
							</div>
							<div>
								{!! Form::checkbox('talla', '43', false) !!}
								<label style="font-weight: normal;">
									<span></span>
									Talla 43
									<small>(<?php $talla = App\Producto::where('talla', '43')->where('tipo_producto', 18)->count(); echo $talla; ?>)</small>
								</label>
							</div>
							<div>
								{!! Form::checkbox('talla', '45', false) !!}
								<label style="font-weight: normal;">
									<span></span>
									Talla 45
									<small>(<?php $talla = App\Producto::where('talla', '45')->where('tipo_producto', 18)->count(); echo $talla; ?>)</small>
								</label>
							</div>
							<br>
							<button type="submit" class="btn btn-secondary">
								Filtrar
							</button>
						</div>
						{!! Form::close() !!}
					</div>

					<div class="aside">
						<h3 class="aside-title">Marcas</h3>
						<div>
							<div>
								<label>
									<a href="/ocultoCalzado">
										<img src="/images/Logo/equipos/NBA.png" alt="" width="15">
										<span></span>
										Todos
										<small>(<?php $categoria = \DB::table('productos')->where('tipo_producto', 18)->count(); echo $categoria; ?>)</small>
									</a>
								</label>
							</div>
							<hr>
							<div>
								<label>
									<a href="/calzado?marca=nike">
										<img src="/images/Logo/marcas/Nike.png" alt="" width="30">
										<span></span>
										Nike
										<small>(<?php $tipo = \DB::table('productos')->where('proveedor', '=', 'Nike')->where('tipo_producto', 18)->count(); echo $tipo; ?>)</small>
									</a>
								</label>
							</div>

							<div>
								<label>
									<a href="/calzado?marca=adidas">
										<img src="/images/Logo/marcas/Adidas.png" alt="" width="30">
										<span></span>
										Adidas
										<small>(<?php $tipo = \DB::table('productos')->where('proveedor', '=', 'Adidas')->where('tipo_producto', 18)->count(); echo $tipo; ?>)</small>
									</a>
								</label>
							</div>

							<div>
								<label>
									<a href="/calzado?marca=jordan">
										<img src="/images/Logo/marcas/Jordan.png" alt="" width="30">
										<span></span>
										Jordan
										<small>(<?php $tipo = \DB::table('productos')->where('proveedor', '=', 'Jordan')->where('tipo_producto', 18)->count(); echo $tipo; ?>)</small>
									</a>
								</label>
							</div>

							<div>
								<label>
									<a href="/calzado?marca=under armour">
										<img src="/images/Logo/marcas/Under.png" alt="" width="30">
										<span></span>
										Under Armour
										<small>(<?php $tipo = \DB::table('productos')->where('proveedor', '=', 'Under Armour')->where('tipo_producto', 18)->count(); echo $tipo; ?>)</small>
									</a>
								</label>
							</div>
						</div>
						<!-- /aside Widget -->
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
									<p class="product-category">{{ $producto->proveedor }}</p>
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

@endif