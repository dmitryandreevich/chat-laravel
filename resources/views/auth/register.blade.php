@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card card-default">
                <div class="card-header">Создание нового профиля</div>

                <div class="card-body">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Имя</label>

                            <div class="col-md-12">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

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
                                <input id="secondName" type="text" class="form-control" name="secondName" value="{{ old('secondName') }}" required autofocus>

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
                                <input id="middleName" type="text" class="form-control" name="middleName" value="{{ old('middleName') }}" required autofocus>

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
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

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
                                <input id="phoneNumber" type="text" class="form-control" name="phoneNumber" value="{{ old('phoneNumber') }}" required>

                                @if ($errors->has('phoneNumber'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phoneNumber') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="aboutMe" class="col-md-4 control-label">О себе</label>

                            <div class="col-md-12">
                                <textarea class="form-control" name="aboutMe" id="aboutMe" cols="30" rows="10"></textarea>
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
                                <label><input type="radio" name="sex" value="Мужской">Мужской</label>
                            </div>
                            <div class="radio">
                                <label><input type="radio" name="sex" value="Женский">Женский</label>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Пароль</label>

                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                
                        <div class="form-group">
                            <label for="password-confirm" class="col-md-6 control-label">Подтвердите пароль</label>

                            <div class="col-md-12">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Регистрация
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
