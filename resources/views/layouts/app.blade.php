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
            <div class="row">

                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="navbar-brand" href="#">SOC</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                        <div class="navbar-nav">
                            @guest
                                <a class="nav-item nav-link active" href="{{ route('login') }}">Вход</a>
                                <a class="nav-item nav-link active" href="{{ route('register') }}">Регистрация</a>
                            @else
                                <a class="nav-item nav-link active" href="{{ route('profile') }}">Профиль</a>
                                <a class="nav-item nav-link active" href="{{ route('people') }}">Люди</a>
                                <a class="nav-item nav-link active" href="{{ 'friends' }}">Друзья<span class="badge badge-info">{{ \App\Http\Controllers\FriendsController::getCountFriends(Auth::user()->id) }}</span></a>
                                <a class="nav-item nav-link active" href="{{ route('sharedChat') }}">Общий чат</a>
                                <a class="nav-item nav-link active" href="{{ route('logout') }}">Выйти</a>


                            @endguest

                        </div>
                    </div>
                </nav>
                <div class="col-md-6">

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
