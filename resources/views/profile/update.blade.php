<?php
/**
 * Created by PhpStorm.
 * User: Dmitry Andreevich
 * Date: 10.05.2018
 * Time: 16:54
 */
?>
@extends('layouts.app')

@section('content')
    @php $user = \Illuminate\Support\Facades\Auth::user(); @endphp
    <div class="container">
        <div id="tabs">
            <ul>
                <li><a href="#tabs-1">Главная фотография</a></li>
                <li><a href="#tabs-2">Обновление профиля</a></li>
            </ul>
            <div id="tabs-1">
                <div class="row">
                    <div class="col-md-6 offset-3">
                        <p>Ваша текущая фотография</p>

                        <img src="{{ asset("storage/avatars/".\Illuminate\Support\Facades\Auth::user()->avatar) }}" alt="avatar" class="photo-profile">
                        <form action="{{ route('updateAvatar') }}" enctype="multipart/form-data" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <input type="file" name="avatar" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="submit" name="changeAvatar" class="form-control btn btn-outline-primary" value="Обновить">
                            </div>
                        </form>
                    </div>

                </div>
            </div>
            <div id="tabs-2">
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <div class="card card-default">
                            <div class="card-header">Обновление профиля</div>

                            <div class="card-body">
                                <form class="form-horizontal" method="POST" action="{{ route('profileUpdate') }}">

                                    {{ csrf_field() }}
                                    {{ method_field('PUT') }}

                                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                        <label for="name" class="col-md-4 control-label">Имя</label>
                                        <div class="col-md-12">
                                            <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" required autofocus>

                                            @if ($errors->has('name'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('secondName') ? ' has-error' : '' }}">
                                        <label for="name" class="col-md-4 control-label">Фамилия</label>

                                        <div class="col-md-12">
                                            <input id="secondName" type="text" class="form-control" name="secondName" value="{{ $user->secondName }}" required autofocus>

                                            @if ($errors->has('secondName'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('secondName') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('middleName') ? ' has-error' : '' }}">
                                        <label for="middleName" class="col-md-4 control-label">Отчество</label>

                                        <div class="col-md-12">
                                            <input id="middleName" type="text" class="form-control" name="middleName" value="{{ $user->middleName }}" required autofocus>

                                            @if ($errors->has('middleName'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('middleName') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <label for="email" class="col-md-4 control-label">E-Mail адрес</label>

                                        <div class="col-md-12">
                                            <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" required>

                                            @if ($errors->has('email'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('phoneNumber') ? ' has-error' : '' }}">
                                        <label for="phoneNumber" class="col-md-4 control-label">Номер телефона</label>

                                        <div class="col-md-12">
                                            <input id="phoneNumber" type="text" class="form-control" name="phoneNumber" value="{{ $user->phoneNumber }}" required>

                                            @if ($errors->has('phoneNumber'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('phoneNumber') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group {{ $errors->has('aboutMe') ? 'has-error' : '' }}">
                                        <label for="aboutMe" class="col-md-4 control-label">О себе</label>

                                        <div class="col-md-12">
                                            <textarea class="form-control" name="aboutMe" id="aboutMe" cols="30" rows="10">{{ $user->aboutMe }}</textarea>
                                            @if ($errors->has('aboutMe'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('aboutMe') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="country" class="col-md-4 control-label">Страна</label>

                                        <div class="col-md-12">
                                            <select name="country" id="country" class="form-control">
                                                <option value="Казахстан">Казахстан</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="city" class="col-md-4 control-label">Город</label>

                                        <div class="col-md-12">
                                            <select name="city" id="city" class="form-control">
                                                <option value="Петропавловск">Петропавловск</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="sex" class="col-md-4 control-label">Пол</label>
                                        <div class="radio">
                                            <label><input type="radio" name="sex" value="Мужской" checked >Мужской</label>
                                        </div>
                                        <div class="radio">
                                            <label><input type="radio" name="sex" value="Женский">Женский</label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary">
                                                Обновить профиль
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script>
        $( function() {
            $( "#tabs" ).tabs();
        } );
    </script>
@endsection

