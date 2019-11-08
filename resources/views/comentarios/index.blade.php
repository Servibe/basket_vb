@extends("../layout.plantilla_footer")

<!doctype html>

<html>
@include('../layout.plantilla_css')

<body>
	@include('../layout.plantilla_header')
	@include('../layout.plantilla_nav')

	<div class="section">
		<div class="container">
			<span class="ir-arriba"><i class="fa fa-angle-double-up"></i></span>
			<div class="row">
				<div class="col-md-7">
					<div class="billing-details">
						@if(count($errors) > 0)
						<div class="alert alert-warning" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
							
							<strong>Campos Obligatorios!!</strong>

							<ul>
								@foreach($errors->all() as $error)

								<li>
									{{$error}}
								</li>

								@endforeach
							</ul>
						</div>
						@endif
						<div class="section-title">
							<h3 class="title">Comentarios</h3>
						</div>
						@if(Auth::check())
						{!! Form::open(['url' => '/comentarios', 'method' => 'post']) !!}
						{{csrf_field()}}
						<div class="form-group">{!! Form::textarea('contenido', old('contenido'), ['class' => 'form-control', 'placeholder' => 'Escribe aqui tu comentario']) !!}</div>
						<div class="form-group">{!! Form::submit('Enviar', ['class' => 'btn btn-success']) !!}</div>
						{!! Form::close() !!}
						@endif
						<br>
						@forelse($comentarios as $comentario)
						<label class="form-group">{{ $comentario->user->username }} {{ $comentario->created_at }}</label>
						<div class="form-group">{{ $comentario->contenido }}</div>

						<hr>
						@empty
						<div class="form-group">No hay comentarios todavía</div>
						@endforelse
					</div>
				</div>
			</div>
			{{ $comentarios->onEachSide(1)->links() }}
		</div>
	</div>

	@include('../layout.plantilla_script')
</body>
</html>