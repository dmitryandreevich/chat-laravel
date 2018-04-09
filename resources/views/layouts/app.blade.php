<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <script src="{{ asset('js/jquery-3.3.1.min.js')}}"></script>

</head>
<body>
    <header class="header" id="header">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-md-4">
                    <a href="/">Social network</a>
                </div>
                <div class="col-md-4">
                    @guest
                        <a href="{{ route('login') }}">Вход</a>
                        <a href="{{ route('register') }}">Регистрация</a>
                    @else
                        <a href="{{ route('profile') }}">Профиль</a>
                        <a href="{{ route('sharedChat') }}">Общий чат</a>
                        <a href="{{ route('logout') }}">Выйти</a>


                        <span class="badge badge-danger">{{ Auth::user()->name }}</span>
                    @endguest
                </div>
            </div>
        </div>
    </header>
    <main class="main" id="main">
        <div class="container">
            @yield('content')
        </div>
    </main>

    <footer class="footer" id="footer">
        <div class="container">
            <div class="row">header</div>
        </div>
    </footer>

    <!-- Scripts -->

</body>
</html>
