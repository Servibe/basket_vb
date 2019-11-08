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
                {!! Form::model($proveedor, ['method' => 'post', 'action' => ['ProveedoresController@update', $proveedor->id]]) !!}
                <div class="col-md-7">
                    <div class="billing-details">
                        <div class="section-title">
                            <h3 class="title">Proveedor</h3>
                        </div>
                        {!! Form::label('nombre', 'Nombre:') !!}
                        <div class="form-group">
                            {!! Form::text('nombre', null, ['class' => 'input']) !!}
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="PUT">
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
                    </div>
                </div>
                <div class="col-md-4 col-xs-6">
                    <div class="billing-details">
                        <div class="section-title">
                            <h3 class="title" style="color:#FDFEFE">A</h3>
                        </div>
                        {!! Form::label('cod_postal', 'Código Postal:') !!}
                        <div class="form-group">
                            {!! Form::text('cod_postal', null, ['class' => 'input']) !!}
                        </div>
                        {!! Form::label('activo', 'Activo:') !!}
                        <div>
                            {!! Form::text('activo', null, ['class' => 'input']) !!}
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