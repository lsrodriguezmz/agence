@extends('layouts.app')

@section('content2')
<div class="container">
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form class="form-signin" method="POST" action="{{ route('password.email') }}">
        {{ csrf_field() }}
        <h2 class="form-signin-heading">Restablecer clave</h2>
        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="email" class="sr-only">E-Mail</label>
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required placeholder="Direccion de correo electronico">
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Solicitar nueva clave</button>
        </div>
    </form>
</div>
@endsection
