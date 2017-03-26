<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content='width=max-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Academy') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="{{ asset('fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">

    <!-- Styles -->
    <link href="{{ asset('plugins/bootstrap-3.3.7/css/bootstrap.min.css') }}" rel="stylesheet">
    <!--<link href="{{ asset('plugins/bootstrap-3.3.7/css/bootstrap-theme.min.css') }}" rel="stylesheet">-->
    <link href="{{ asset('css/site.css') }}" rel="stylesheet">
    
    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
    @include('ajax.modal')
    <div id="app">
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Academy') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                         @if (Auth::guest())

                         @else
                        <li><a href="{{ url('/publications') }}"> Noticias <small class="label label-primary">+42</small></a></li>
                        <li><a href="{{ url('/dashboard') }}">Cursos <small class="label label-primary">+42</small></a></li>

                        <form class="navbar-form navbar-left" role="search">
                          
                          <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search">
                          
                                <a type="submit" class="input-group-addon">
                                    <span class="fa fa-search"></span>
                                </a>
                            </div>
                              

                          </div>
                        </form>
                        @endif
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="padding: 10px 0px 10px 0px;">
                                <span class="user user-color user-fa-1" style="display: inline-block; margin-left:5px;">
                                    {{ str_limit(Auth::user()->name, 1, '') }}{{ str_limit(Auth::user()->last_name, 1, '') }}
                                </span> 
                                {{ Auth::user()->username }} 
                                <span class="fa fa-caret-down user" style="padding: 2px !important; margin-right:5px;"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="#" style="padding-left: 8px !important;"> {{ Auth::user()->name }} {{ Auth::user()->last_name }} ({{ Auth::user()->username }})
                                        <small style="margin-left: 8px; display: block;">{{ Auth::user()->email }}</small>
                                    </a>
                                    </li>
                                <li role="separator" class="divider"></li>
                                <li>
                                    <a href="{{ url('/#') }}"><i class="fa fa-btn fa fa-cog"></i> Configuración</a></li>
                                <li>
                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
            @yield('content')    
        </div>
    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/jquery-3.1.1.js') }}"></script>
    <script src="{{ asset('plugins/jquery-ui-1.12.1/jquery-ui.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-3.3.7/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/site.js') }}"></script>
    <script src="{{ asset('js/MessageModal.js') }}"></script>
    @stack('scripts')
</body>
</html>
