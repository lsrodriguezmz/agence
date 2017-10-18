<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Prueba Agence Luis</title>
    <link rel="icon" type="image/png" href="{{asset('img/agence_icon.png')}}" />

    <!-- Styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <link href="{{ asset('css/signin.css') }}" rel="stylesheet">
    <link href="{{ asset('font-awesome-4.7.0/css/font-awesome.min.css') }}" rel="stylesheet">
    {!! Charts::assets() !!}

    <!-- link href="{{ asset('css/app.css') }}" rel="stylesheet" -->
</head>
<body cz-shortcut-listen="true" style="">
    @if( Auth::user() != null)
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="{{ route('home') }}" style="margin-left: 47px; margin-right: 47px;">
            <img src="{{ ('img/logo2.png') }}" alt="agence" class="img-responsive">
        </a>

      
      <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#navbardark" aria-controls="navbardark" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbardark">
        <ul class="navbar-nav mr-auto">
            <li><a href="#" class="nav-link disabled">Proyectos</a></li>
            <li><a href="#" class="nav-link disabled">Administrativo</a></li>
            <li><a href="{{ route('consultores') }}" class="nav-link active">Comercial</a></li>
            <li><a href="#" class="nav-link disabled">Financiero</a></li>
        </ul>

        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="dropdown1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }}</a>
                <div class="dropdown-menu" aria-labelledby="dropdown1">
                    <a class="dropdown-item" href="#">Perfil</a>
                    <a class="dropdown-item" href="#">Bandeja</a>
                    <a class="dropdown-item" href="#">Configuracion</a>
                </div>
            </li>
        </ul>
        <button class="btn btn-outline-danger my-2 my-sm-0" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Salir</button>
        
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
      </div>
    </nav>
<br>
    @endif
    <div class="container-fluid">
        <form id="mainForm">

    @yield('content')

        </form>
    @yield('content2')
    </div>
    <!-- Scripts -->
    <!-- script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>

    <!-- script src="{{ asset('js/app.js') }}"></script -->
</body>
</html>
