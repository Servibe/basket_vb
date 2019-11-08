@extends('../layout.plantilla_footer')

<!doctype html>

<html>
@include('../layout.plantilla_css')

<body>
	@include('../layout.plantilla_header')
	
	@include('../layout.plantilla_nav')

	<div class="section">
		<div class="container">
			<div class="row">
				<h1>Cambiar contraseña</h1>

				@if(Session::has('message'))
				<div class="text-danger">
					{{ Session::get('message') }}
				</div>
				@endif
				<hr>

				<form method="post" action="/usuario/updatepassword">
					{{csrf_field()}}
					<div class="form-group">
						<label for="mypassword">Actual contraseña:</label>
						<input type="password" name="mypassword" class="input">
						<div class="text-danger">{{ $errors->first('mypassword') }}</div>
					</div>
					<div class="form-group">
						<label for="password">Nueva contraseña:</label>
						<input type="password" name="password" class="input">
						<div class="text-danger">{{ $errors->first('password') }}</div>
					</div>
					<div class="form-group">
						<label for="mypassword">Confirma la nueva contraseña:</label>
						<input type="password" name="password_confirmation" class="input">
					</div>

					<button type="submit" class="btn btn-primary">Cambiar</button>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<button type="button" class="btn btn-primary-danger"><a href="/home">Cancelar</a></button>
				</form>
			</div>
		</div>
	</div>

	@include('../layout.plantilla_script')
</body>
</html>