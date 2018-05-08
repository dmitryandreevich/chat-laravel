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
    <link href="{{ asset('css/jquery-ui.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <script src="{{ asset('js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('js/ChatClient.js') }}"></script>
    <script src="{{ asset('js/ion.sound.min.js') }}"></script>

</head>
<body>
    <header class="header" id="header">
        <div class="row justify-content-between no-gutters">
            <div class="col-md-4">
                <p class="title">Social network</p>
            </div>
            <div class="col-md-2">
                <p><a href="">Гость.</a></p>
            </div>
        </div>
    </header>
    <div class="site-main">
        <div class="row no-gutters">
            <div class="col-md-2">
                <div class="left-sidebar">
                    <nav>
                        <ul>
                            @guest
                                <li><a href="{{ route('login') }}"><span class="text-link">Вход</span></a></li>
                                <li><a href="{{ route('register') }}"><span class="text-link">Регистрация</span></a></li>
                            @else
                                <li><a href="{{ route('profile') }}"><span class="text-link">Профиль</span></a></li>
                                <li><a href="{{ route('people') }}"><span class="text-link">Люди</span></a></li>
                                <li class="dropdown-link"><a href="{{ 'friends' }}">
                                        <span class="text-link">Друзья <span class="dropdown-toggle"></span> </span>
                                    </a>
                                    <ul class="drop-list">
                                        <li><a href="">Все</a></li>
                                        <li><a href="">Заявки</a></li>
                                    </ul>
                                </li>

                                <li><a href="{{ route('sharedChat') }}"><span class="text-link">Общий чат</span></a></li>
                                <li><a  href="{{ route('logout') }}"><span class="text-link">Выйти</span></a></li>

                            @endguest
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="col-md-10">
                <main class="main" id="main">
                    <div class="container">
                        @yield('content')
                    </div>
                </main>
            </div>
        </div>
    </div>

    <script>
        // Main js script
        $(document).ready(function () {
            ion.sound({
                sounds: [
                    {
                        name: "message"
                    },
                ],
                volume: 0.5,
                path: "<?php echo asset('audio').'/' ?>",
                preload: true
            });

        });
        $('.dropdown-link').hover(function () {
           $(this).find('.drop-list').slideToggle();
        });
    </script>
</body>
</html>
