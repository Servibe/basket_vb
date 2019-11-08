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
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <h2>{{ __('Register') }}</h2>
                        <hr>
                    </div>
                </div>
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-3 field-label-responsive">
                            <label for="username">{{ __('Username') }}</label>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                    <div class="input-group-addon" style="width: 2.6rem"><i class="fa fa-user"></i></div>
                                    <input type="text" name="username" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" id="username"
                                    value="{{ old('username') }}" required autofocus>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-control-feedback">
                                <span class="text-danger align-middle">
                                    @if ($errors->has('username'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 field-label-responsive">
                            <label for="nombre">{{ __('Nombre') }}</label>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                    <div class="input-group-addon" style="width: 2.6rem"><i class="fa fa-user"></i></div>
                                    <input type="text" name="nombre" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" id="nombre"
                                    value="{{ old('nombre') }}" required autofocus>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-control-feedback">
                                <span class="text-danger align-middle">
                                    @if ($errors->has('nombre'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nombre') }}</strong>
                                    </span>
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 field-label-responsive">
                            <label for="apellidos">{{ __('Apellidos') }}</label>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                    <div class="input-group-addon" style="width: 2.6rem"><i class="fa fa-user"></i></div>
                                    <input type="text" name="apellidos" class="form-control{{ $errors->has('apellidos') ? ' is-invalid' : '' }}" id="apellidos"
                                    value="{{ old('apellidos') }}" required autofocus>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-control-feedback">
                                <span class="text-danger align-middle">
                                    @if ($errors->has('apellidos'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('apellidos') }}</strong>
                                    </span>
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 field-label-responsive">
                            <label for="email">{{ __('Correo') }}</label>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                    <div class="input-group-addon" style="width: 2.6rem"><i class="fa fa-at"></i></div>
                                    <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" id="email"
                                    value="{{ old('email') }}" required autofocus>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-control-feedback">
                                <span class="text-danger align-middle">
                                    @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 field-label-responsive">
                            <label for="localidad">{{ __('Localidad') }}</label>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                    <div class="input-group-addon" style="width: 2.6rem"><i class="fa fa-user"></i></div>
                                    <input type="text" name="localidad" class="form-control{{ $errors->has('localidad') ? ' is-invalid' : '' }}" id="localidad"
                                    value="{{ old('localidad') }}" required autofocus>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-control-feedback">
                                <span class="text-danger align-middle">
                                    @if ($errors->has('localidad'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('localidad') }}</strong>
                                    </span>
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 field-label-responsive">
                            <label for="provincia">{{ __('Provincia') }}</label>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                    <div class="input-group-addon" style="width: 2.6rem"><i class="fa fa-user"></i></div>
                                    <input type="text" name="provincia" class="form-control{{ $errors->has('provincia') ? ' is-invalid' : '' }}" id="provincia"
                                    value="{{ old('provincia') }}" required autofocus>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-control-feedback">
                                <span class="text-danger align-middle">
                                    @if ($errors->has('provincia'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('provincia') }}</strong>
                                    </span>
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 field-label-responsive">
                            <label for="calle">{{ __('Calle') }}</label>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                    <div class="input-group-addon" style="width: 2.6rem"><i class="fa fa-user"></i></div>
                                    <input type="text" name="calle" class="form-control{{ $errors->has('calle') ? ' is-invalid' : '' }}" id="calle"
                                    value="{{ old('calle') }}" required autofocus>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-control-feedback">
                                <span class="text-danger align-middle">
                                    @if ($errors->has('calle'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('calle') }}</strong>
                                    </span>
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 field-label-responsive">
                            <label for="cod_postal">{{ __('Código Postal') }}</label>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                    <div class="input-group-addon" style="width: 2.6rem"><i class="fa fa-user"></i></div>
                                    <input type="text" name="cod_postal" class="form-control{{ $errors->has('cod_postal') ? ' is-invalid' : '' }}" id="cod_postal"
                                    value="{{ old('cod_postal') }}" required autofocus>
                                    <input type="hidden" class="form-control{{ $errors->has('activo') ? ' is-invalid' : '' }}" name="activo" value="1" required autofocus>
                                    <input type="hidden" class="form-control{{ $errors->has('recibir_ofertas') ? ' is-invalid' : '' }}" name="recibir_ofertas" value="1" required autofocus>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-control-feedback">
                                <span class="text-danger align-middle">
                                    @if ($errors->has('cod_postal'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('cod_postal') }}</strong>
                                    </span>
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 field-label-responsive">
                            <label for="password">{{ __('Password') }}</label>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group has-danger">
                                <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                    <div class="input-group-addon" style="width: 2.6rem"><i class="fa fa-key"></i></div>
                                    <input type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" id="password"
                                    required>
                                </div>
                                @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 field-label-responsive">
                            <label for="password-confirm">{{ __('Confirm Password') }}</label>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                    <div class="input-group-addon" style="width: 2.6rem">
                                        <i class="fa fa-repeat"></i>
                                    </div>
                                    <input type="password" name="password_confirmation" class="form-control"
                                    id="password-confirm" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-user-plus"></i> {{ __('Register') }}
                            </button>
                        </div>
                    </div>
                </form>
                <center>
                    <button class="btn btn-info" data-toggle="modal" data-target="#recuperar">
                        Recuperar cuenta existente
                    </button>
                    <div id="recuperar" class="modal modal-success fade" tableindex="-1" role="dialog" aria-labelledby="myModelLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <form method="post" action="/usuario/recuperar">
                                    {{csrf_field()}}
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <h2 class="modal-title text-center" id="myModalLabel">Recuperación</h2>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>Correo:</label>
                                            <input type="email" name="email" class="input">
                                        </div>
                                        <div class="form-group">
                                            <label>Nueva contraseña:</label>
                                            <input type="password" class="input" name="password">
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-success" type="submit">
                                                Enviar
                                            </button>
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">
                                                Cancelar
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div> 
                </center>
            </div>
        </div>
    </div>

    @include('../layout.plantilla_script')
</body>
</html>