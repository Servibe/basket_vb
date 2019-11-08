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
                {!! Form::model($producto, ['method' => 'post', 'action' => ['StockController@update', $producto->id]]) !!}
                <div class="col-md-7">
                    <div class="billing-details">
                        <div class="section-title">
                            <h3 class="title">Producto</h3>
                        </div>
                        {!! Form::label('nombre', 'Nombre:') !!}
                        <div class="form-group">
                            {!! Form::text('nombre', null, ['class' => 'input', 'disabled' => 'disabled']) !!}
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="PUT">
                        </div>
                        {!! Form::label('talla', 'Talla:') !!}
                        <div class="form-group">
                            {!! Form::text('talla', null, ['class' => 'input', 'disabled' => 'disabled']) !!}
                        </div>
                        {!! Form::label('equipo', 'Equipo:') !!}
                        <div class="form-group">
                            {!! Form::text('equipo', null, ['class' => 'input', 'disabled' => 'disabled']) !!}
                        </div>
                        {!! Form::label('tipo_producto', 'Tipo Producto:') !!}
                        <div class="form-group">
                            {!! Form::text('tipo_producto', null, ['class' => 'input', 'disabled' => 'disabled']) !!}
                        </div>
                        {!! Form::label('proveedor', 'Proveedor:') !!}
                        <div class="form-group">
                            {!! Form::text('proveedor', null, ['class' => 'input', 'disabled' => 'disabled']) !!}
                        </div>
                        {!! Form::label('iva', 'IVA:') !!}
                        <div class="form-group">
                            {!! Form::text('iva', null, ['class' => 'input', 'disabled' => 'disabled']) !!}
                        </div>
                        {!! Form::label('precio_compra', 'Precio Compra:') !!}
                        <div class="form-group">
                            {!! Form::text('precio_compra', null, ['class' => 'input', 'disabled' => 'disabled']) !!}
                        </div>
                        {!! Form::label('pvp', 'PVP:') !!}
                        <div class="form-group">
                            {!! Form::text('pvp', null, ['class' => 'input', 'disabled' => 'disabled']) !!}
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
                        {!! Form::label('stock_actual', 'Unidades a añadir:') !!}
                        <div class="form-group">
                            {!! Form::hidden('stock_actual', null, ['class' => 'input']) !!}
                            {!! Form::text('stock_actual_nuevo', null, ['class' => 'input']) !!}
                        </div>
                        {!! Form::label('stock_maximo', 'Stock Máximo:') !!}
                        <div class="form-group">
                            {!! Form::text('stock_maximo', null, ['class' => 'input', 'disabled' => 'disabled']) !!}
                        </div>
                        {!! Form::label('stock_minimo', 'Stock Mínimo:') !!}
                        <div class="form-group">
                            {!! Form::text('stock_minimo', null, ['class' => 'input', 'disabled' => 'disabled']) !!}
                        </div>
                        {!! Form::label('foto', 'Foto:') !!}
                        <div class="file">
                            <?php 
                            echo '<img src="../../images/'.$producto->foto.'" width="100">';
                            ?>
                        </div>
                        {!! Form::label('activo', 'Activo:') !!}
                        <div class="form-group">
                            {!! Form::text('activo', null, ['class' => 'input', 'disabled' => 'disabled']) !!}
                        </div>
                    </div>
                </div>
                <center>
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-outline-primary">
                            Actualizar
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