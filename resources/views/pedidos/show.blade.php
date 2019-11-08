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
							<h3 class="title">Pedido</h3>
						</div>
						{!! Form::label('id', 'Pedido:') !!}
						<div class="form-group">
							{!! Form::text('id', $pedido->id, ['class' => 'input', 'disabled' => 'disabled']) !!}
						</div>
						{!! Form::label('user_id', 'Id Cliente:') !!}
						<div class="form-group">
							{!! Form::text('id_cliente', $pedido->user_id, ['class' => 'input', 'disabled' => 'disabled']) !!}
						</div>
						{!! Form::label('subtotal', 'Subtotal:') !!}
						<div class="form-group">
							{!! Form::text('subtotal', $pedido->subtotal, ['class' => 'input', 'disabled' => 'disabled']) !!}
						</div>
						{!! Form::label('envio', 'Envio:') !!}
						<div class="form-group">
							{!! Form::text('envio', $pedido->envio, ['class' => 'input', 'disabled' => 'disabled']) !!}
						</div>
						{!! Form::label('factura', 'Factura:') !!}
						<div class="form-group">
							@if(($pedido->factura_id) != 0)
							<a href="{{ route('verFactura', $pedido->id) }}" target="_blank">
								<i class="fa fa-check"></i>
							</a>
							@else
							<a href="{{ route('imprimirFactura', $pedido->id) }}" onclick="reload(3);">
								<i class="fa fa-times"></i>
							</a>
							@endif
							<!-- {!! Form::text('factura', $pedido->factura, ['class' => 'input', 'disabled' => 'disabled']) !!} -->
						</div>
						{!! Form::label('precio', 'Precio:') !!}
						<div class="form-group">
							{!! Form::text('precio', $pedido->pedido_items[0]->precio, ['class' => 'input', 'disabled' => 'disabled']) !!}
						</div>
						{!! Form::label('producto_id', 'Producto:') !!}
						<div class="form-group">
							{!! Form::text('producto_id', $pedido->pedido_items[0]->producto_id, ['class' => 'input', 'disabled' => 'disabled']) !!}
						</div>
					</div>
				</div>
				<div class="col-md-4 col-xs-6">
					<div class="billing-details">
						<div class="section-title">
							<h3 class="title" style="color:#FDFEFE">H</h3>
						</div>
						{!! Form::label('unidades', 'Unidades:') !!}
						<div class="form-group">
							{!! Form::text('unidades', $pedido->pedido_items[0]->unidades, ['class' => 'input', 'disabled' => 'disabled']) !!}
						</div>
						{!! Form::label('fecha_pedido', 'Fecha Pedido:') !!}
						<div class="form-group">
							{!! Form::text('fecha_pedido', $pedido->fecha_pedido, ['class' => 'input', 'disabled' => 'disabled']) !!}
						</div>
						{!! Form::label('fecha_envio', 'Fecha Envio:') !!}
						<div class="form-group">
							{!! Form::text('fecha_envio', $pedido->fecha_envio, ['class' => 'input', 'disabled' => 'disabled']) !!}
						</div>
						{!! Form::label('fecha_entrega', 'Fecha Entrega:') !!}
						<div class="form-group">
							{!! Form::text('fecha_entrega', $pedido->fecha_entrega, ['class' => 'input', 'disabled' => 'disabled']) !!}
						</div>
						{!! Form::label('metodo_pago', 'Método de Pago:') !!}
						<div class="form-group">
							{!! Form::text('metodo_pago', $pedido->metodo_pago, ['class' => 'input', 'disabled' => 'disabled']) !!}
						</div>
					</div>
				</div>
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