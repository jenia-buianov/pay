<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
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

                    </ul>

                    <div class="collapse navbar-collapse">
                        <ul class="navbar-nav ml-auto">
                            @if(!\Illuminate\Support\Facades\Auth::check())
                                <li class="button-container nav-item iframe-extern">
                                    <a href="{{url('admin/login')}}" class="nav-link">{{__('Login')}}</a>
                                </li>
                                <li class="button-container nav-item iframe-extern">
                                    <a href="{{route('register')}}" class="btn  btn-primary btn-round btn-block">
                                        <i class="fas fa-sign-in-alt"></i> {{__('Register')}}
                                        <div class="ripple-container"></div></a>
                                </li>
                            @else
                                <li class="button-container nav-item iframe-extern">
                                    <a href="{{url('admin')}}" class="nav-link"><i class="fas fa-chart-area"></i> {{__('Overview')}}</a>
                                </li>
                            @endif
                        </ul>
                    </div>


                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
