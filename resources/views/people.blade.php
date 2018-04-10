<?php
/**
 * Created by PhpStorm.
 * User: Dmitry Andreevich
 * Date: 09.04.2018
 * Time: 19:41
 */?>

@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <nav class="navbar navbar-dark ">
                <form class="form-inline">
                    <input class="form-control mr-sm-2" type="search" placeholder="Поиск" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Поиск</button>
                </form>
            </nav>
        </div>
    </div>
    <div class="row">


    @foreach($users as $user)
        <div class="col-md-4">
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="{{ asset('images/no-photo.png') }}" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">{{ "$user->name $user->secondName" }}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">{{ "$user->country/$user->city" }}</h6>
                    <p class="card-text">{{  $user->aboutMe }}.</p>
                    <a href="{{ route('profileShow',['user' => $user->id]) }}" class="card-link">Перейти</a>
                    <a href="#" class="card-link">Добавить в друзья</a>
                </div>
            </div>
        </div>

    @endforeach
    </div>

    <div class="row">
        {{ $users->render() }}

    </div>
@endsection
