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
				<div class="col-md-7">
					<div class="billing-details">
						<div class="section-title">
							<h3 class="title">Cliente</h3>
						</div>
						{!! Form::label('user_id', 'Id Usuario:') !!}
						<div class="form-group">
							{!! Form::text('user_id', $cliente->user_id, ['class' => 'input', 'disabled' => 'disabled']) !!}
						</div>
						{!! Form::label('username', 'Username:') !!}
						<div class="form-group">
							{!! Form::text('username', $cliente->user->username, ['class' => 'input', 'disabled' => 'disabled']) !!}
						</div>
						{!! Form::label('password', 'Password:') !!}
						<div class="form-group">
							<div class="form-group">
								<input class="input" type="password" name="password" value="{{$cliente->user->password}}" disabled="disabled">
							</div>
						</div>
						{!! Form::label('nombre', 'Nombre:') !!}
						<div class="form-group">
							{!! Form::email('nombre', $cliente->nombre, ['class' => 'input', 'disabled' => 'disabled']) !!}
						</div>
						{!! Form::label('apellidos', 'Apellidos:') !!}
						<div class="form-group">
							{!! Form::text('apellidos', $cliente->apellidos, ['class' => 'input', 'disabled' => 'disabled']) !!}
						</div>
						{!! Form::label('email', 'Correo:') !!}
						<div class="form-group">
							{!! Form::text('email', $cliente->user->email, ['class' => 'input', 'disabled' => 'disabled']) !!}
						</div>
						{!! Form::label('localidad', 'Localidad:') !!}
						<div class="form-group">
							{!! Form::text('localidad', $cliente->localidad, ['class' => 'input', 'disabled' => 'disabled']) !!}
						</div>
					</div>
				</div>
				<div class="col-md-4 col-xs-6">
					<div class="billing-details">
						<div class="section-title">
							<h3 class="title" style="color:#FDFEFE">H</h3>
						</div>
						{!! Form::label('provincia', 'Provincia:') !!}
						<div class="form-group">
							{!! Form::text('provincia', $cliente->provincia, ['class' => 'input', 'disabled' => 'disabled']) !!}
						</div>
						{!! Form::label('calle', 'Calle:') !!}
						<div class="form-group">
							{!! Form::text('calle', $cliente->calle, ['class' => 'input', 'disabled' => 'disabled']) !!}
						</div>
						{!! Form::label('cod_postal', 'Código Postal:') !!}
						<div class="form-group">
							{!! Form::text('cod_postal', $cliente->cod_postal, ['class' => 'input', 'disabled' => 'disabled']) !!}
						</div>
						{!! Form::label('activo', 'Activo:') !!}
						<div class="form-group">
							{!! Form::text('activo', $cliente->activo, ['class' => 'input', 'disabled' => 'disabled']) !!}
						</div>
					</div>
				</div>
				{!! Form::close() !!}
				<center>
					<div class="col-sm-10">
						<button type="button" class="btn btn-outline-primary"><a href="{{ URL::previous() }}">Volver</a></button>
					</div>
				</center>
			</div>
		</div>
	</div>

	@include('../layout.plantilla_script')

</body>
</html>