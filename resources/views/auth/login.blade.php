@extends("../layout.plantilla_footer")

<!doctype html>

<html>
@include('../layout.plantilla_css')

<body>
    @include('../layout.plantilla_header')
    
    @include('../layout.plantilla_nav')

    <div class="section">
        <div class="container">
            @include('flash::message')
            <div class="row">
                <div class="col-md-12">
                    <div class="modal-dialog" style="margin-bottom:0">
                        <div class="modal-content">
                            <div class="panel-heading">
                                <h3 class="panel-title">{{ __('Login') }}</h3>
                            </div>
                            <div class="panel-body">
                                <form method="post" action="{{ route('login') }}">
                                    @csrf
                                    <fieldset>
                                        <div class="form-group">
                                            <label for="username">{{ __('Username') }}</label>
                                            <input class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" id="email" name="username" value="{{ old('username') }}" type="text" required autofocus>

                                            @if ($errors->has('username'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('username') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="password">{{ __('Password') }}</label>
                                            <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" id="password" name="password" type="password" required autofocus>

                                            @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        <div class="checkbox">
                                            <label for="remember">
                                                <input name="remember" type="checkbox" id="remember" {{ old('remember') ? 'checked' : '' }}>{{ __('Mantenme conectado') }}
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-sm btn-success">
                                                {{ __('Login') }}
                                            </button>

                                            @if (Route::has('password.request'))
                                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                            @endif
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    @include('../layout.plantilla_script')
</body>
</html>