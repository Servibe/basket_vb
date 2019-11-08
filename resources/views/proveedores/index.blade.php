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
							{!! Form::open(['url' => '/proveedores', 'method' => 'get']) !!}
							{!! Form::text('nombre', null, ['class' => 'input', 'placeholder' => 'Nombre']) !!}
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
				<div id="aside" class="col-md-3">
					<div class="aside">
						<h3 class="aside-title">Proveedores</h3>
						<div>
							<div>
								<label>
									<a href="/proveedores/create">Alta Proveedores</a>
								</label>
							</div>
							<div>
								<label>
									<a href="/proveedoresA">Activos</a>
								</label>
							</div>
						</div>
					</div>
				</div>

				<div class="table-responsive text-nowrap">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>Nombre</th>
								<th>Correo</th>
								<th>Teléfono</th>
								<th>Localidad</th>
								<th>Provincia</th>
								<th>Calle</th>
								<th>País</th>
								<th>Código Postal</th>
								<th>Activo</th>
							</tr>
						</thead>

						<tbody>
							@foreach($proveedores as $proveedor)
							<tr>
								<td><a href="{{route('proveedores.edit', $proveedor->id)}}">{{$proveedor->nombre}}</a></td>
								<td>{{$proveedor->correo}}</td>
								<td>{{$proveedor->telefono}}</td>
								<td>{{$proveedor->localidad}}</td>
								<td>{{$proveedor->provincia}}</td>
								<td>{{$proveedor->calle}}</td>
								<td>{{$proveedor->pais}}</td>
								<td>{{$proveedor->cod_postal}}</td>
								<td>{{$proveedor->activo}}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
					{{ $proveedores->onEachSide(1)->links() }}
				</div>
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /SECTION -->

	<center>
		<button type="button" class="btn btn-outline-primary">
			<a href="{{route('imprimirProveedores')}}">
				Imprimir
			</a>
		</button>
	</center><br>

	@include('../layout.plantilla_script')

</body>
</html>