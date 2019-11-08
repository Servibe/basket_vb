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
							<div>
								{!! Form::open(['url' => '/productosA', 'method' => 'get', 'role' => 'search']) !!}
								{!! Form::hidden(null, csrf_token()) !!}
								<?php
								$equipos = App\Equipo::pluck('nombre', 'nombre')->all();
								?>
								{!! Form::select('equipo', $equipos, null, ['class' => 'input']) !!}
								<button type="submit" class="search-btn">Search</button>

								<p></p>

								{!! Form::open(['url' => '/productosA', 'method' => 'get']) !!}
								<?php
								$tipos = App\TiposProducto::pluck('nombre', 'id')->all();
								?>
								{!! Form::select('tipo_producto', $tipos, null, ['class' => 'input']) !!}
								<button type="submit" class="search-btn">Search</button>
							</div>
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
								<td><a href="{{ url('/producto/precio', $producto->id)}}">{{$producto->pvp}}</a></td>
								<td><a href="{{ route('stock.edit', $producto->id) }}">{{$producto->stock_actual}}</a></td>
								<td><img src="images/{{$producto->foto}}" alt="" width="100"></td>
								@if($producto->tipo_producto != 17)
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
			<a href="{{route('imprimirProductosA')}}">
				Imprimir
			</a>
		</button>
	</center><br>

	@include('../layout.plantilla_script')

</body>
</html>