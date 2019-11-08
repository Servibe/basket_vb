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
							{!! Form::open(['url' => '/clientes', 'method' => 'get', 'role' => 'search']) !!}
							{!! Form::hidden(null, csrf_token()) !!}
							{!! Form::text('apellidos', null, ['class' => 'input', 'placeholder' => 'Apellidos']) !!}
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
						<h3 class="aside-title">Clientes</h3>
						<div>
							<div>
								<label>
									<a href="/clientes">Todos</a>
								</label>
							</div>
						</div>
					</div>
				</div>

				<div class="table-responsive text-nowrap">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>Id Usuario</th>
								<th>Username</th>
								<th>Password</th>
								<th>Nombre</th>
								<th>Apellidos</th>
								<th>Correo</th>
								<th>Localidad</th>
								<th>Provincia</th>
								<th>Calle</th>
								<th>Código Postal</th>
								<th>Activo</th>
							</tr>
						</thead>

						<tbody>
							@foreach($activos as $cliente)
							<tr>
								<td>{{$cliente->user_id}}</td>
								<td><a href="{{route('clientes.show', $cliente->id)}}">{{$cliente->user->username}}</a></td>
								<td>{{$cliente->user->password}}</td>
								<td>{{$cliente->nombre}}</td>
								<td>{{$cliente->apellidos}}</td>
								<td>{{$cliente->user->email}}</td>
								<td>{{$cliente->localidad}}</td>
								<td>{{$cliente->provincia}}</td>
								<td>{{$cliente->calle}}</td>
								<td>{{$cliente->cod_postal}}</td>
								<td>{{$cliente->activo}}</td>
								<td></td>
							</tr>
							@endforeach
						</tbody>
					</table>
					{{ $activos->onEachSide(1)->links() }}
				</div>
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /SECTION -->

	<center>
		<button type="button" class="btn btn-outline-primary">
			<a href="{{route('imprimirClientesA')}}">
				Imprimir
			</a>
		</button>
		&nbsp;&nbsp;&nbsp;
		<button type="button" class="btn btn-success">
			<a href="/exportarA" style="color:#FDFEFE">
				Excel
			</a>
		</button>
	</center><br>

	@include('../layout.plantilla_script')

</body>
</html>