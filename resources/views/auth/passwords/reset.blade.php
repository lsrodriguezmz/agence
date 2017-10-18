@extends('layouts.app')

@section('content2')
<div class="container">
    <form class="form-signin" method="POST" action="{{ route('password.request') }}">
        {{ csrf_field() }}
        <h2 class="form-signin-heading">Restablecer clave</h2>
        <input type="hidden" name="token" value="{{ $token }}">

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="email" class="sr-only">E-Mail</label>
            <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" required autofocus placeholder="Direccion de correo electronico">
            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <label for="password" class="sr-only">Nueva clave</label>
            <input id="password" type="password" class="form-control" name="password" required placeholder="Nueva clave de acceso">
            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
            <label for="password-confirm" class="sr-only">Confirmar clave</label>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="Confirmar clave">
            @if ($errors->has('password_confirmation'))
                <span class="help-block">
                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Cambiar clave</button>
        </div>
    </form>
</div>
@endsection
