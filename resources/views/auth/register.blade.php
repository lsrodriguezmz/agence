@extends('layouts.app')

@section('content2')
<div class="container">
    <form class="form-signin" method="POST" action="{{ route('register') }}">
        {{ csrf_field() }}
        <h2 class="form-signin-heading">Registrar usuario</h2>

        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="name" class="sr-only">Nombre</label>
            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus placeholder="Nombre del usuario">
            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="email" class="sr-only">E-Mail</label>
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required placeholder="Direccion de correo electronico">
            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <label for="password" class="sr-only">Clave</label>
            <input id="password" type="password" class="form-control" name="password" required placeholder="Clave de acceso">
            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group">
            <label for="password-confirm" class="sr-only">Confirmar clave</label>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="Confirmar clave">
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Aceptar</button>
        </div>
    </form>
</div>
@endsection
