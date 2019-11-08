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
				{!! Form::open(['url' => '/productos', 'method' => 'post', 'files' => true]) !!}
				<div class="col-md-7">
					<div class="billing-details">
						<div class="section-title">
							<h3 class="title">Producto</h3>
						</div>
						{!! Form::label('nombre', 'Nombre:') !!}
						<div class="form-group">
							{!! Form::text('nombre', null, ['class' => 'input']) !!}
							{{csrf_field()}}
						</div>
						{!! Form::label('descripcion', 'Descripción:') !!}
						<div class="form-group">
							{!! Form::textarea('descripcion', null, ['class' => 'input']) !!}
						</div>
						{!! Form::label('talla', 'Talla:') !!}
						<div class="form-group">
							<?php
							$tallas = App\Talla::pluck('nombre', 'nombre')->all();
							?>
							{!! Form::select('talla', $tallas, null, ['class' => 'input']) !!}
						</div>
						{!! Form::label('equipo', 'Equipo:') !!}
						<div class="form-group">
							<?php
							$equipos = App\Equipo::pluck('nombre', 'nombre')->all();
							?>
							{!! Form::select('equipo', $equipos, null, ['class' => 'input']) !!}
						</div>
						{!! Form::label('tipo_producto', 'Tipo Producto:') !!}
						<div class="form-group">
							<?php
							$tipos = App\TiposProducto::pluck('nombre', 'id')->all();
							?>
							{!! Form::select('tipo_producto', $tipos, null, ['class' => 'input']) !!}
						</div>
						{!! Form::label('proveedor', 'Proveedor:') !!}
						<div class="form-group">
							<?php
							$proveedores = App\Proveedor::orderBy('nombre')->pluck('nombre', 'nombre')->all();
							?>
							{!! Form::select('proveedor', $proveedores, null, ['class' => 'input']) !!}
						</div>
						{!! Form::label('iva', 'IVA:', ['style' => 'display:none']) !!}
						<div class="form-group">
							{!! Form::hidden('iva', 21, ['class' => 'input']) !!}
						</div>
						{!! Form::label('codigo_barras', null, ['style' => 'display:none'], 'Código de barras:') !!}
						<div class="form-group">
							{!! Form::hidden('codigo_barras', null, ['class' => 'input']) !!}
						</div>
					</div>
				</div>
				<div class="col-md-4 col-xs-6">
					<div class="billing-details">
						<div class="section-title">
							<h3 class="title" style="color:#FDFEFE">H</h3>
						</div>
						{!! Form::label('precio_compra', 'Precio Compra:') !!}
						<div class="form-group">
							{!! Form::text('precio_compra', null, ['class' => 'input']) !!}
						</div>
						{!! Form::label('pvp', 'PVP:') !!}
						<div class="form-group">
							{!! Form::text('pvp', null, ['class' => 'input']) !!}
						</div>
						{!! Form::label('stock_actual', 'Stock Actual:', ['style' => 'display:none']) !!}
						<div class="form-group">
							{!! Form::hidden('stock_actual', 100, ['class' => 'input']) !!}
						</div>
						{!! Form::label('stock_maximo', null, ['style' => 'display:none'], 'Stock Máximo:') !!}
						<div class="form-group">
							{!! Form::hidden('stock_maximo', 100, ['class' => 'input']) !!}
						</div>
						{!! Form::label('stock_minimo', null, ['style' => 'display:none'], 'Stock Mínimo:') !!}
						<div class="form-group">
							{!! Form::hidden('stock_minimo', 10, ['class' => 'input']) !!}
						</div>
						{!! Form::label('foto', 'Foto:') !!}
						<div class="file">
							{!! Form::file('foto', null, ['class' => 'input']) !!}
							{!! Form::hidden('activo', 1, ['class' => 'input']) !!}
							{!! Form::hidden('rebajado', 0, ['class' => 'input']) !!}
							{!! Form::hidden('rebaja_inicio', null, ['class' => 'input']) !!}
							{!! Form::hidden('rebaja_fin', null, ['class' => 'input']) !!}
						</div>
					</div>
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
				{!! Form::close() !!}
			</div>
		</div>
	</div>

	@include('../layout.plantilla_script')

</body>
</html>


