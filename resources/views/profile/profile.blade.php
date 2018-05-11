@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-4 offset-md-0">
            <div class="profile-block">
                <img src="{{ asset("storage/avatars/$user->avatar") }}" alt="" class="photo-profile">

                <a href="{{ route('profileUpdatePage') }}" class="btn btn-outline-primary profile-edit" style="width: 100%">Изменить профиль</a>

            </div>
        </div>
        <div class="col-md-8 offset-md-0">
            <div class="profile-block">
                <div class="profile-block-header">
                    {{ "{$user->name} {$user->secondName} {$user->middleName}"}}
                </div>
                <hr>
                <div class="profile-block-content">
                    <p>id: <span class="badge badge-info">{{ $user->id }}</span></p>

                    <p>Страна-город: <span class="badge badge-info">{{ "{$user->country} - {$user->city}" }}</span></p>

                    <p>Телефон: <span class="badge badge-info">{{ $user->phoneNumber }}</span></p>
                </div>
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-md-4 offset-md-0">
            <div class="profile-block friends-block">
                <div class="profile-block-header">
                    <div class="row justify-content-between">
                        <div class="col-md-4"><p>Друзья 1</p></div>
                        <div class="col-md-5"><a href="" class="card-link">Показать всех</a></div>
                    </div>
                </div>
                <div class="profile-block-content">
                    <div class="row no-gutters">
                        @foreach($friends as $friend)
                            <div class="friend col-md-4">
                                <a href="{{ route('profileShow',['id' => $friend->id]) }}" class="friend-link">
                                    <img src="{{ asset("storage/avatars/$friend->avatar") }}" alt="" class="friend-photo">
                                    <span class="name">{{ $friend->name }}</span>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="feed">
                <div class="profile-block new-post">
                    <div class="profile-block-header">
                        <span>Напишите новую новость...</span>
                    </div>
                    <div class="profile-block-content">
                        <form action="{{ route('publications.store') }}" method="post">
                            {{ csrf_field() }}
                            <textarea name="postText" id="post-text" class="form-control"></textarea>

                            <input type="submit" value="Опубликовать" class="btn btn-outline-primary form-control post-send" name="post-send">
                        </form>

                    </div>
                </div>
                <div class="profile-block post-list">
                    <div class="profile-block-header">
                        Все записи пользователя
                    </div>
                    <hr >
                    <div class="profile-block-content">

                    </div>
                </div>
                @foreach($publications as $publication)
                    <div class="profile-block">
                        <div class="profile-block-header">
                            <img src="{{ asset("storage/avatars/$user->avatar") }}" alt="avatar" class="avatar">
                            <div class="header-info">
                                <p class="post-author"></p>
                                <p class="post-date">{{ $publication->created_at }}</p>
                            </div>
                        </div>
                        <hr >
                        <div class="profile-block-content">
                            <div class="post-message">
                                {{ $publication->text }}
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
           let postArea = $('#post-text');
            let btnPostSend = $('.post-send');

            postArea.keyup(() => {
                let scrollHeight = postArea[0].scrollHeight;
                if(scrollHeight > 26) postArea.css('height',scrollHeight);
           });

            postArea.focus(()=>{
                btnPostSend.css('display','block');
                btnPostSend.animate({ opacity: 1 },700);
            });
            postArea.focusout(() => {
                btnPostSend.animate({ opacity: 0 },500, () => btnPostSend.css('display', 'none'));
            });
        });
    </script>
@endsection