<?php
/**
 * Created by PhpStorm.
 * User: Dmitry Andreevich
 * Date: 20.04.2018
 * Time: 19:09
 */

?>
@extends('friends.layout')


@section('friends-content')
    <h6>Все друзья</h6>

    @foreach($friends as $friend)
        <div class="profile-block">
            <h5 class="profile-block-header">{{ "$friend->name $friend->secondName" }}</h5>
            <div class="profile-block-content">
                <img src="{{ asset("storage/avatars/$friend->avatar") }}" style="width: 12%">
                <a href="{{ route('private.show',['user' => $friend->id]) }}" class="card-link">Написать сообщение</a>
                <a href="{{ route('profileShow',['user' => $friend->id]) }}" class="card-link">Перейти в профиль</a>
                <a href="{{ route('friendsCancelRequest',['user' => $friend->id]) }}" class="card-link">Удалить из друзей</a>
            </div>
        </div>

    @endforeach
@endsection
