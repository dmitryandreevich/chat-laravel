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
    <h6>Все подписчики <span class="badge badge-light">{{ count($requests) }}</span></h6>
    @foreach($requests as $request)
        <div class="profile-block">
            <h5 class="profile-block-header">{{ "$request->name $request->secondName" }}</h5>
            <div class="profile-block-content">
                <img src="{{ asset("storage/avatars/$request->avatar") }}" style="width: 12%">
                <a href="{{ route('friendsAcceptRequest',['user' => $request->id]) }}" class="card-link">Принять запрос</a>
                <a href="{{ route('profileShow',['user' => $request->id]) }}" class="card-link">Перейти в профиль</a>
            </div>
        </div>

    @endforeach
@endsection

