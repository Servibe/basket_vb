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
				{!! Form::open(['url' => '/proveedores', 'method' => 'post']) !!}
				<div class="col-md-7">
					<div class="billing-details">
						<div class="section-title">
							<h3 class="title">Proveedor</h3>
						</div>
						{!! Form::label('nombre', 'Nombre:') !!}
						<div class="form-group">
							{!! Form::text('nombre', null, ['class' => 'input']) !!}
							{{csrf_field()}}
						</div>
						{!! Form::label('correo', 'Correo:') !!}
						<div class="form-group">
							{!! Form::email('correo', null, ['class' => 'input']) !!}
						</div>
						{!! Form::label('telefono', 'Teléfono:') !!}
						<div class="form-group">
							{!! Form::text('telefono', null, ['class' => 'input']) !!}
						</div>
						{!! Form::label('localidad', 'Localidad:') !!}
						<div class="form-group">
							{!! Form::text('localidad', null, ['class' => 'input']) !!}
						</div>
						{!! Form::label('provincia', 'Provincia:') !!}
						<div class="form-group">
							{!! Form::text('provincia', null, ['class' => 'input']) !!}
						</div>
						{!! Form::label('calle', 'Calle:') !!}
						<div class="form-group">
							{!! Form::text('calle', null, ['class' => 'input']) !!}
						</div>
						{!! Form::label('pais', 'País:') !!}
						<div class="form-group">
							{!! Form::text('pais', null, ['class' => 'input']) !!}
						</div>
						{!! Form::label('cod_postal', 'Código Postal:') !!}
						<div class="form-group">
							{!! Form::text('cod_postal', null, ['class' => 'input']) !!}
							{!! Form::hidden('activo', 1, ['class' => 'input']) !!}
						</div>
					</div>
					<center>
						<div class="col-sm-10">
							<button type="submit" class="btn btn-outline-primary">
								Enviar
							</button>
							<button type="button" class="btn btn-outline-primary">
								<a href="{{ URL::previous() }}">
									Volver
								</a>
							</button>
						</div>
					</center>
				</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>

	@if(count($errors) > 0)
	<div class="alert alert-warning alert-dismissible fade show" role="alert">
		<strong>Campos Obligatorios!!</strong>


		<ul>
			@foreach($errors->all() as $error)

			<li>
				{{$error}}
			</li>

			@endforeach
		</ul>

		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
	@endif

	@include('../layout.plantilla_script')

</body>
</html>


