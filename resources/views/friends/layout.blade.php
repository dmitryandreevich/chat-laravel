<?php
/**
 * Created by PhpStorm.
 * User: Dmitry Andreevich
 * Date: 10.04.2018
 * Time: 12:51
 */
?>

@extends('layouts.app')




@section('content')
    <div class="row">
        <div class="col-md-2">
            <div class="card">
                <div class="card-title">Меню</div>
                <div class="card-text">
                    <nav class="friends-navigation">
                        <ul>
                            <li><a href="{{ route('friends') }}" class="card-link">Все друзья <span class="badge badge-info">1</span></a></li>
                            <li><a href="{{ route('requests') }}" class="card-link">Заявки в друзья  <span class="badge badge-info">1</span></a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <div class="col-md-10">
            @yield('friends-content')
        </div>
    </div>

@endsection
