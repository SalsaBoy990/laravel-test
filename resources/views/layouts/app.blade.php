<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="description" content="@yield('page_description', 'Tárold el saját receptjeidet egy alkalmazásban rendszerezve.')">

    <title>@yield('page_title', 'Receptjeim')</title>
    

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400;1,600;1,700&display=swap" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-primary shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @auth
                        <li>
                            <a class="nav-link{{ Request::is('home') ? ' active' : '' }}" href="/home">Home</a>
                        </li>
                        @endauth

                        @guest
                        <li>
                            <a class="nav-link{{ Request::is('/') ? ' active' : '' }}" href="/">Start</a>
                        </li>
                        @endguest
                        <li>
                            <a class="nav-link{{ Request::is('recipe*') ? ' active' : '' }}" href="/recipe">Recipes</a>
                        </li>
                        <li>
                            <a class="nav-link{{ Request::is('tag*') ? ' active' : '' }}" href="/tag">Tags</a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                            
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="/user/{{ Auth::user()->id }}">
                                        {{ __('Profil') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main>
            @isset($message_success)
            <div class="container py-4">
                <div class="alert alert-success no-bullets" role="alert">
                   {!! $message_success !!}
                </div>
            </div>
            @endisset

            @isset($message_warning)
            <div class="container py-4">
                <div class="alert alert-warning no-bullets" role="alert">
                   {!! $message_warning !!}
                </div>
            </div>
            @endisset

            @if($errors->any())
            <div class="container py-4">
                <div class="alert alert-danger no-bullets small" role="alert">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                        <li>{!! $error !!}</li>
                        @endforeach
                    </ul> 
                </div>
            </div>
            @endif
            @yield('content')
        </main>
        <footer style="width: 100%" class="bg-primary mt-3">
            @include('shared.footer')
        </footer>
    </div>
</body>
</html>
