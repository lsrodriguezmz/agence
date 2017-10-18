@extends('layouts.app')

@section('content2')
<div class="container">
    <form class="form-signin" method="POST" action="{{ route('login') }}">
        {{ csrf_field() }}
        <h2 class="form-signin-heading">Iniciar Sesion</h2>
        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="inputEmail" class="sr-only">E-mail</label>
            <input id="inputEmail" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus placeholder="Direccion de correo electronico">
            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <label for="inputPassword" class="sr-only">Clave</label>
            <input id="inputPassword" type="password" class="form-control" name="password" required placeholder="Clave de acceso">
            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group">
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Mantener sesion
                </label>
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-lg btn-primary btn-block">Aceptar</button>

            <a class="btn btn-link" href="{{ route('register') }}">Registrarse</a>
            <a class="btn btn-link" href="{{ route('password.request') }}">Olvide mi clave</a>
        </div>
    </form>
</div>
@endsection
