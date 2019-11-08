@extends("../layout.plantilla_footer")

<!doctype html>

<html>
@include('../layout.plantilla_css')

<body>
	@include('../layout.plantilla_header')
	
	@include('../layout.plantilla_nav')

	<div class="section">
		<div class="container">
			<div class="row">
				@include('flash::message')
				<div class="col-md-7">
					<div class="billing-details">
						<div class="section-title">
							<h3 class="title">Mi Perfil</h3>
						</div>
						{!! Form::label('username', 'Username:') !!}
						<div class="form-group">
							{!! Form::text('username', $usuario->username, ['class' => 'input', 'disabled' => 'disabled']) !!}
						</div>
						{!! Form::label('nombre', 'Nombre:') !!}
						<div class="form-group">
							{!! Form::text('nombre', $usuario->cliente->nombre, ['class' => 'input', 'disabled' => 'disabled']) !!}
						</div>
						{!! Form::label('apellidos', 'Apellidos:') !!}
						<div class="form-group">
							{!! Form::text('apellidos', $usuario->cliente->apellidos, ['class' => 'input', 'disabled' => 'disabled']) !!}
						</div>
						{!! Form::label('correo', 'Correo:') !!}
						<div class="form-group">
							{!! Form::email('correo', $usuario->email, ['class' => 'input', 'disabled' => 'disabled']) !!}
						</div>
						{!! Form::label('localidad', 'Localidad:') !!}
						<div class="form-group">
							{!! Form::text('localidad', $usuario->cliente->localidad, ['class' => 'input', 'disabled' => 'disabled']) !!}
						</div>
						{!! Form::label('calle', 'Calle:') !!}
						<div class="form-group">
							{!! Form::text('calle', $usuario->cliente->calle, ['class' => 'input', 'disabled' => 'disabled']) !!}
						</div>
						{!! Form::label('cod_postal', 'Código Postal:') !!}
						<div class="form-group">
							{!! Form::text('cod_postal', $usuario->cliente->cod_postal, ['class' => 'input', 'disabled' => 'disabled']) !!}
						</div>
					</div>
					<center>
						<div class="col-sm-10">
							<button type="button" class="btn btn-outline-primary"><a href="/home">Inicio</a></button>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<button type="button" class="btn btn-outline-primary"><a href="/usuario/cambiar">Editar Perfil</a></button>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							@if(Auth::user()->hasRole('user'))
							<button class="btn btn-warning" data-catid="{{ $usuario->id }}" data-toggle="modal" data-target="#delete">Desactivar Cuenta</button>
							<br><br>
							<button class="btn btn-danger" data-catid="{{ $usuario->id }}" data-toggle="modal" data-target="#eliminar">Eliminar cuenta</button>
							@endif
						</div>
					</center>
				</div>
				@if(Auth::user()->hasRole('Admin'))
				<div class="col-md-4 col-xs-6" style="display:none">
					<div class="shop">
						<div class="shop-img">
							<img src="/images/muestra/1553531509Los Ángeles Lakers.png" alt="">
						</div>
						<div class="shop-body">
							<h3>Confección<br>Colección</h3>
							<a href="/confeccion" class="cta-btn">Compra ya <i class="fa fa-arrow-circle-right"></i></a>
						</div>
					</div>
				</div>
				<div class="col-md-4 col-xs-6" style="display:none">
					<div class="shop">
						<div class="shop-img">
							<img src="/images/muestra/Boston Celtics 1969.png" alt="">
						</div>
						<div class="shop-body">
							<h3>Accesorios<br>Colección</h3>
							<a href="/accesorios" class="cta-btn">Compra ya <i class="fa fa-arrow-circle-right"></i></a>
						</div>
					</div>
				</div>
				@else 
				<div class="col-md-4 col-xs-6">
					<div class="shop">
						<div class="shop-img">
							<img src="/images/muestra/1553531509Los Ángeles Lakers.png" alt="">
						</div>
						<div class="shop-body">
							<h3>Confección<br>Colección</h3>
							<a href="/confeccion" class="cta-btn">Compra ya <i class="fa fa-arrow-circle-right"></i></a>
						</div>
					</div>
				</div>
				<div class="col-md-4 col-xs-6">
					<div class="shop">
						<div class="shop-img">
							<img src="/images/muestra/Boston Celtics 1969.png" alt="">
						</div>
						<div class="shop-body">
							<h3>Accesorios<br>Colección</h3>
							<a href="/accesorios" class="cta-btn">Compra ya <i class="fa fa-arrow-circle-right"></i></a>
						</div>
					</div>
				</div>
				@endif
			</div>
		</div>
	</div>


	<div class="modal modal-danger fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title text-center" id="myModalLabel">Confirmación de desactivación</h4>
				</div>

				{!! Form::model($usuario, ['method' => 'post', 'action' => ['UsuariosController@update', $usuario->id]]) !!}
				{{csrf_field()}}
				<div class="modal-body">
					<p class="text-center">Estas seguro de que deseas desvincular la cuenta?</p>
					<input type="hidden" name="activo" value="0">
					<input type="hidden" name="_method" value="PUT">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-info" data-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn btn-success">Desactivar</button>
				</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>

	<div class="modal modal-danger fade" id="eliminar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title text-center" id="myModelLabel">Confirmación de eliminación</h4>
				</div>

				{{ Form::model($usuario, ['method' => 'post', 'action' => ['UsuariosController@eliminar', $usuario->id]]) }}
				{{csrf_field()}}
				<div class="modal-body">
					<p class="text-center">Estas seguro de que deseas eliminar la cuenta</p>
					<input type="hidden" name="recibir_ofertas" value="0">
					<input type="hidden" name="activo" value="0">
					
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-info" data-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn btn-success">Eliminar</button>
				</div>
				{{ Form::close() }}
			</div>
		</div>
	</div>

	@include('../layout.plantilla_script')

</body>
</html>