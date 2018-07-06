<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Dierenambulance') }}</title>

        <!-- Styles -->

        <link rel="stylesheet" type="text/css" href="{{ asset('css/leaflet.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/animate.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ url('/') }}/css/style.css">

        <!-- Scripts -->
        <script type="text/javascript" src="{{asset('js/angular.min.js') }}"></script>
        <script type="text/javascript" src="{{asset('js/jquery.min.js') }}"></script>
        <script type="text/javascript" src="{{asset('js/bootstrap.min.js') }}"></script>
        <script type="text/javascript" src="{{asset('js/register.js') }}"></script>
        <script src="https://cdn.polyfill.io/v2/polyfill.min.js"></script>
    </head>
    <body class="@yield('body_class')">
        <div id="app">
            <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
                <div class="container">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img class="logo" src="{{ asset('images/Dierenambulance-logo.png') }}">
                    </a>

                    <button id="no-scroll" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <!-- <ul class="navbar-nav mr-auto">
                        </ul> -->
                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            @guest
                                <li><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                            @else
                            <li {{{ (Request::is('melding') ? 'class=active' : '') }}}>
                              <a class="nav-link" href="/">
                                Meldingen
                              </a>
                            </li>
                            <li {{{ (Request::is('buswissel') ? 'class=active' : '') }}}>
                              <a class="nav-link" href="{{ route('buswissel.index') }}">
                                Buswissel
                              </a>
                            </li>
                            <li class="nav-item dropdown {{ (Request::is(['administratie', 'bus', 'bekende-adressen', 'exporteren', 'kwartaalverslag']) ? 'active' : '') }}">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Administratie
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                  <a class="dropdown-item" href="{{ route('Administratie') }}"> Gebruikers </a>
                                  <a class="dropdown-item" href="{{ route('bus.index') }}"> Voertuigen </a>
                                  <a class="dropdown-item" href="{{ route('bekende-adressen.index') }}"> Bekende adressen </a>
                                  <a class="dropdown-item" href="{{ route('Exporteren') }}"> Exporteren </a>
                                  <a class="dropdown-item" href="{{ route('Kwartaaloverzicht') }}"> Kwartaaloverzicht </a>
                                </div>
                            </li>
                            <li {{{ (Request::is('profiel') ? 'class=active' : '') }}}>
                              <a class="nav-link" href="{{ route('profiel.index') }}">
                                Mijn profiel
                              </a>
                            </li>
                            <li {{{ (Request::is('profiel/*') ? 'active' : '') }}}>
                              <a class="nav-link" href="{{ route('logout') }}"
                                 onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                                 Uitloggen
                              </a>
                              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                  @csrf
                              </form>
                            </li>
                        @endguest
                        </ul>
                    </div>
                </div>
            </nav>
            <div>
                @yield('map')
            </div>
            <main>
                @yield('content')
            </main>
        </div>
        </div>
        @yield('scripts')
        <script src="{{ asset('js/app.js') }}"></script>

    </body>

</html>
