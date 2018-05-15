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
    <link rel="stylesheet" href="{{ asset('css/fontawesome-all.min.css') }}">
    <script src="{{ asset('js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('js/ChatClient.js') }}"></script>
    <script src="{{ asset('js/ion.sound.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
</head>
<body>
    <div class="site-main">
        <div class="row no-gutters">
            <div class="col-md-2">
                <div class="left-sidebar">
                    <nav>
                        <ul>
                            @guest
                                <a href="{{ route('people') }}"> <li><i class="fas fa-users"></i><span class="text-link">Люди</span></li></a>
                                <a href="{{ route('login') }}"> <li><i class="fas fa-sign-out-alt"></i><span class="text-link">Вход</span></li></a>
                                <a href="{{ route('register') }}"><li><i class="fas fa-user-plus"></i><span class="text-link">Регистрация</span></li></a>
                            @else
                                <a href="{{ route('profile') }}"><li><i class="far fa-user-circle"></i><span class="text-link">Профиль</span></li></a>
                                <a href="{{ route('publications.index') }}"> <li><i class="fas fa-newspaper"></i><span class="text-link">Лента</span></li></a>
                                <a href="{{ route('people') }}"> <li><i class="fas fa-users"></i><span class="text-link">Люди</span></li></a>
                                <li class="dropdown-link">
                                    <a href="{{ route('friends') }}">
                                        <span class="text-link"><i class="fas fa-user-friends"></i>
                                            Друзья <span class="dropdown-toggle"></span> </span>
                                    </a>
                                    <ul class="drop-list">
                                        <a href="{{ route('friends') }}"> <li>Все</li></a>
                                        <a href="{{ route('requests') }}"><li>Заявки</li></a>
                                    </ul>
                                </li>

                                <a href="{{ route('chat.index') }}"><li><i class="fas fa-comments"></i><span class="text-link">Общий чат</span></li></a>
                                <a  href="{{ route('logout') }}"><li><i class="fas fa-sign-out-alt"></i><span class="text-link">Выйти</span></li></a>
                            @endguest
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="col-md-10">
                <main class="main" id="main">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="dashboard-header">

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="dashboard-content">
                                    @yield('content')

                                </div>
                            </div>

                        </div>
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
                path: "{{ asset('audio').'/' }}",
                preload: true
            });

        });
        $('.dropdown-link').hover(function () {
           $(this).find('.drop-list').slideToggle();
        });
    </script>
</body>
</html>
