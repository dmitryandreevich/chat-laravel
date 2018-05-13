<?php
/**
 * Created by PhpStorm.
 * User: Dmitry Andreevich
 * Date: 11.05.2018
 * Time: 17:50
 */
?>
@extends('layouts.app')


@section('content')
    <div class="row feed">

        <div class="col-md-8 offset-md-2">
            <div class="profile-block">
                <div class="profile-block-header"><span>Все публикации ваших друзей</span>
                </div>
            </div>
            @foreach($friendsPublications as $publication)
                <div class="profile-block">
                    <div class="profile-block-header">
                        <img src="{{ asset("storage/avatars/". $publication->author->avatar) }}" alt="avatar" class="avatar">
                        <div class="header-info">
                            <p class="post-author">{{ $publication->author->name . ' ' . $publication->author->secondName }}</p>
                            <p class="post-date">{{ $publication->created_at }}</p>
                        </div>
                    </div>
                    <hr >
                    <div class="profile-block-content">
                        <div class="post-message">
                            {{ $publication->text }}
                        </div>
                        <hr>
                        <div class="post-options">
                            <button class="btn-like" name="btnLike" onclick="giveLike(this)" id="{{ $publication->id }}"><i class="fas fa-thumbs-up count">{{ $publication->likes }}</i></button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <script>

    </script>

@endsection
