@extends("../layout.plantilla_footer")

<!DOCTYPE html>

<html>
@include('layout.plantilla_css')

<body>
	@include('layout.plantilla_header')
	
	@include('layout.plantilla_nav')

	<div class="section">
		<div class="container">
			<div class="row">
				<h1>Contáctenos</h1>

				@if(Session::has('success'))
				<div class="alert alert-success">
					{{Session::get('success')}}
				</div>
				@endif

				{!! Form::open(['route'=>'contactus.store']) !!}

				<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
					{!! Form::label('Nombre:') !!}
					{!! Form::text('name', old('name'), ['class'=>'form-control', 'placeholder' => 'Nombre']) !!}
					<span class="text-danger">{{ $errors->first('name') }}</span>
				</div>

				<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
					{!! Form::label('Email:') !!}
					{!! Form::text('email', old('email'), ['class'=>'form-control', 'placeholder' => 'Introduce tu Email']) !!}
					<span class="text-danger">{{ $errors->first('email') }}</span>
				</div>

				<div class="form-group {{ $errors->has('message') ? 'has-error' : '' }}">
					{!! Form::label('Mensaje:') !!}
					{!! Form::textarea('message', old('message'), ['class'=>'form-control', 'placeholder' => 'Mensaje']) !!}
					<span class="text-danger">{{ $errors->first('message') }}</span>
				</div>

				<div class="form-group">
					<button class="btn btn-success">Enviar</button>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					@if(Auth::check())
					<button type="button" class="btn btn-outline-primary"><a href="/home">Inicio</a></button>
					@else
					<button type="button" class="btn btn-outline-primary"><a href="/">Inicio</a></button>
					@endif
				</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>

	@include('layout.plantilla_script')
</body>
</html>