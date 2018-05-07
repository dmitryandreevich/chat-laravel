<?php
/**
 * Created by PhpStorm.
 * User: Dmitry Andreevich
 * Date: 20.04.2018
 * Time: 20:01
 */
?>
@extends('friends.layout')


@section('friends-content')
    <h6>Все подписчики</h6>
    @foreach($requests as $request)
        <div class="card">
            <h5 class="card-header">{{ "$request->name $request->secondName" }}</h5>
            <div class="card-body">
                <img src="{{ asset('images/no-photo.png') }}" style="width: 12%">
                <a href="{{ route('friendsCancelRequest',['user' => $request->id]) }}" class="card-link">Принять запрос</a>
                <a href="{{ route('profileShow',['user' => $request->id]) }}" class="card-link">Перейти в профиль</a>
            </div>
        </div>

    @endforeach
@endsection

