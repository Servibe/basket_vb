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
							{!! Form::open(['url' => '/productosR', 'method' => 'get', 'role' => 'search']) !!}
							{!! Form::hidden(null, csrf_token()) !!}
							{!! Form::date('rebaja_fin', null, ['class' => 'input']) !!}
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

	<div class="section">
		<div class="container">
			<div class="row">
				@include('flash::message')
				
				@include('../layout.plantilla_aside')

				<?php
				$total_rebajas = \DB::table('productos')->where('rebajado', '!=', 0)->count();
				?>
				@if($total_rebajas != 0)
				<div class="table-responsive text-nowrap">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>Nombre</th>
								<th>Fin de Rebaja</th>
								<th>Talla</th>
								<th>Equipo</th>
								<th>Marca</th>
								<th>PVP</th>
								<th>Stock Actual</th>
								<th>Foto</th>
								<th>Rebajado</th>
							</tr>
						</thead>

						<tbody>
							<?php
							$count = 0;
							?>
							@foreach($productos as $producto)
							<tr>
								<td><a href="{{route('productos.edit', $producto->id)}}">{{$producto->nombre}}</a></td>
								<td>{{$producto->rebaja_fin}}</td>
								<td>{{$producto->talla}}</td>
								<td>{{$producto->equipo}}</td>
								<td>{{$producto->proveedor}}</td>
								<td><a href="{{ url('/producto/precio', $producto->id)}}">{{$producto->pvp}}</a></td>
								<td><a href="{{ route('stock.edit', $producto->id) }}">{{$producto->stock_actual}}</a></td>
								<td><img src="images/{{$producto->foto}}" alt="" width="100"></td>
								<td>
									<center>
										{!! Form::model($producto, ['method' => 'post', 'action' => ['ProductosController@normal', $producto->id]]) !!}
										{!! Form::submit('Quitar rebaja', ['class' => 'btn btn-danger']) !!}
										{!! Form::close() !!}
									</center>
								</td>
							</tr>
							<?php
							$count++;
							?>
							@endforeach
						</tbody>
					</table>
					{{ $productos->onEachSide(1)->links() }}
				</div>
				@else
				<center>
					<h3>NO HAY PRODUCTOS EN REBAJAS</h3>
				</center>
				@endif
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /SECTION -->

	@include('../layout.plantilla_script')

</body>
</html>