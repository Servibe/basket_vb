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
				<form method="post" action="/usuario/actualizar">
					<div class="col-md-7">
						<div class="billing-details">
							<div class="section-title">
								<h3 class="title">Mi Perfil</h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; @if(Auth::user()->hasRole('user')) @if((Auth::user()->cliente->recibir_ofertas) != 0) {!! Form::checkbox('recibir_ofertas', '0', false) !!} <strong> No recibir ofertas de rebajas.</strong> @else {!! Form::checkbox('recibir_ofertas', '1', false) !!} <strong> Recibir ofertas de rebajas.</strong> @endif @endif
							</div>
							{!! Form::label('nombre', 'Nombre:') !!}
							<div class="form-group">
								{{csrf_field()}}
								<input type="text" class="input" name="nombre" value="{{Auth::user()->cliente->nombre}}">
							</div>
							{!! Form::label('apellidos', 'Apellidos:') !!}
							<div class="form-group">
								<input type="text" class="input" name="apellidos" value="{{Auth::user()->cliente->apellidos}}">
							</div>
							{!! Form::label('localidad', 'Localidad:') !!}
							<div class="form-group">
								<input type="text" class="input" name="localidad" value="{{Auth::user()->cliente->localidad}}">
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
								<input type="text" class="input" name="provincia" value="{{Auth::user()->cliente->provincia}}">
							</div>
							{!! Form::label('calle', 'Calle:') !!}
							<div class="form-group">
								<input type="text" class="input" name="calle" value="{{Auth::user()->cliente->calle}}">
							</div>
							{!! Form::label('cod_postal', 'Código Postal:') !!}
							<div class="form-group">
								<input type="text" class="input" name="cod_postal" value="{{Auth::user()->cliente->cod_postal}}">
							</div>
						</div>
					</div>
					<center>
						<div class="col-sm-10">
							<button type="submit" class="btn btn-outline-primary">
								Actualizar
							</button>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<button type="button" class="btn btn-outline-primary"><a href="/usuario/password">Cambiar password</a></button>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<button type="button" class="btn btn-outline-primary">
								<a href="{{ URL::previous() }}">
									Volver
								</a>
							</button>
						</div>
					</center>
				</form>
			</div>
		</div>
	</div>

	@include('../layout.plantilla_script')
</body>
</html>