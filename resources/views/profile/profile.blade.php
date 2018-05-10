@extends('layouts.app')

@section('content')
    <?php $user = Auth::user(); ?>
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
                    <div class="row">
                        <div class="friend col-md-4">
                            <a href="" class="friend-link">
                                <img src="{{ asset('storage/avatars/no-photo.png') }}" alt="" class="friend-photo">
                            </a>
                        </div>
                        <div class="friend col-md-4">
                            <a href="" class="friend-link">
                                <img src="{{ asset('storage/avatars/no-photo.png') }}" alt="" class="friend-photo">
                            </a>
                        </div>
                        <div class="friend col-md-4">
                            <a href="" class="friend-link">
                                <img src="{{ asset('storage/avatars/no-photo.png') }}" alt="" class="friend-photo">
                            </a>
                        </div>
                        <div class="friend col-md-4">
                            <a href="" class="friend-link">
                                <img src="{{ asset('storage/avatars/no-photo.png') }}" alt="" class="friend-photo">
                            </a>
                        </div>
                        <div class="friend col-md-4">
                            <a href="" class="friend-link">
                                <img src="{{ asset('storage/avatars/no-photo.png') }}" alt="" class="friend-photo">
                            </a>
                        </div>
                        <div class="friend col-md-4">
                            <a href="" class="friend-link">
                                <img src="{{ asset('storage/avatars/no-photo.png') }}" alt="" class="friend-photo">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="feed">
                <div class="profile-block">
                    <div class="profile-block-header">
                        Все записи пользователя
                    </div>
                    <hr >
                    <div class="profile-block-content">

                    </div>
                </div>
                <div class="profile-block">
                    <div class="profile-block-header">
                        <img src="{{ asset('storage/avatars/no-photo.png') }}" alt="avatar" class="avatar">
                        <div class="header-info">
                            <p class="post-author">Дмитрий Скрипак</p>
                            <p class="post-date">12.01.12</p>
                        </div>

                    </div>
                    <hr >
                    <div class="profile-block-content">
                        <div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A atque eos hic ipsa maxime natus
                            nemo nulla obcaecati quaerat quidem quod saepe voluptas, voluptatum! Culpa esse ex nulla
                            omnis voluptatum.
                        </div>
                        <div>Delectus distinctio ea exercitationem fugit labore molestias neque odit quos? Amet animi
                            delectus eius, eligendi eos et facilis fugiat laboriosam minima molestias officiis, quod
                            ratione reiciendis similique sit tempore vero.
                        </div>
                        <div>Deserunt distinctio dolores facere harum nemo quasi, tenetur voluptatum. Aperiam asperiores
                            assumenda dignissimos dolores esse eveniet fugiat illum ipsam molestiae nihil quibusdam,
                            reprehenderit sequi, similique? A aliquam consequatur numquam sit.
                        </div>
                        <div>Accusamus accusantium asperiores eius error eveniet inventore laborum, minus nam officiis,
                            qui totam veniam? Atque cupiditate dignissimos dolore doloremque dolores id laudantium modi,
                            nihil nisi odio possimus sequi ut? Repellat?
                        </div>
                        <div>A consectetur illum laborum natus nobis odit quibusdam ratione suscipit! Accusamus alias
                            asperiores aspernatur, dolorum ea fugiat incidunt labore maxime nobis omnis quam, quasi quia
                            reiciendis, reprehenderit soluta veritatis voluptatem.
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection