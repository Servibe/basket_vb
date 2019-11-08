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
							{!! Form::open(['url' => '/pedidos', 'method' => 'get', 'role' => 'search']) !!}
							{!! Form::hidden(null, csrf_token()) !!}
							{!! Form::date('fecha_pedido', null, ['class' => 'input']) !!}
							<button type="submit" class="search-btn">Search</button>
							<p></p>
							{!! Form::date('fecha_pedido2', null, ['class' => 'input']) !!}
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
								<th>Id Factura</th>
								<th>Factura</th>
								<th>Unidades</th>
								<th>Precio</th>
								<th>Fecha Pedido</th>
								<th>Fecha Envio</th>
								<th>Fecha Entrega</th>
								<th>Método de Pago</th>
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
								<td>{{$pedido->factura_id}}</td>
								@else
								<td>Sin registro de la factura</td>
								@endif
								@if(($pedido->factura_id) != 0)
								<td>
									<a href="{{ route('verFactura', $pedido->id) }}" target="_blank">
										<i class="fa fa-check"></i>
									</a>
								</td>
								@else
								<td><i class="fa fa-times"></i></td>
								@endif
								<td>{{$pedido->pedido_items[0]->unidades}}</td>
								<td>{{$pedido->pedido_items[0]->precio}}</td>
								<td>{{$pedido->fecha_pedido}}</td>
								<td>{{$pedido->fecha_envio}}</td>
								<td>{{$pedido->fecha_entrega}}</td>
								<td>{{$pedido->metodo_pago}}</td>
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
		<button type="button" class="btn btn-outline-primary">
			<a href="{{route('imprimirPedidos')}}">Imprimir</a>
		</button>
		&nbsp;&nbsp;&nbsp;
		<button type="button" class="btn btn-success">
			<a data-toggle="modal" data-target="#excel">
				Excel
			</a>
		</button>
	</center><br>

	<div class="modal modal-danger fade" id="excel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title text-center" id="myModelLabel">Excel de Pedidos</h4>
				</div>

				{{ Form::open(['url' => '/exportarPedidos', 'method' => 'get']) }}
				<div class="modal-body">
					<p class="text-center">Exportación</p>
					<center>
						<label>De </label>
						<input type="date" class="input" name="fecha1">
						<label> a </label>
						<input type="date" class="input" name="fecha2">
					</center>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-success" name="fechas" onclick="reload(4);">Generar</button>
					<button type="submit" class="btn btn-info" name="todos" onclick="reload(4);">Generar Todos</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
				</div>
				{{ Form::close() }}
			</div>
		</div>
	</div>

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