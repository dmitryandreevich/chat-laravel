<?php
/**
 * Created by PhpStorm.
 * User: Dmitry Andreevich
 * Date: 09.04.2018
 * Time: 19:41
 *
 */
use App\Http\Controllers\FriendsController;
use Illuminate\Support\Facades\Auth;
?>

@extends('layouts.app')

@section('content')

    <div class="row">

    @foreach($users as $user)
        <div class="col-md-4">
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="{{ asset("storage/avatars/$user->avatar") }}" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">{{ "$user->name $user->secondName" }}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">{{ "$user->country/$user->city" }}</h6>
                    <p class="card-text">{{  $user->aboutMe }}.</p>
                    <a href="{{ route('profileShow',['user' => $user->id]) }}" class="card-link">Перейти</a>

                    @php
                        if(Auth::user()->id !== $user->id){
                            $isFriend = FriendsController::isFriend($user->id);
                            if(!$isFriend){
                                $isSub = FriendsController::isSub($user->id);
                                $isTaker = FriendsController::isTaker($user->id);
                                //var_dump($isSub);
                                //var_dump($isTaker);
                            }
                        }
                    @endphp

                    @if(Auth::user()->id !== $user->id)
                        @if($isFriend)
                            <a href="{{ route('friendsCancelRequest',['user' => $user->id]) }}" class="card-link">Удалить из друзей</a>
                        @else
                            @if($isSub)
                                <a href="{{ route('friendsAcceptRequest',['user' => $user->id]) }}" class="card-link">Принять запрос</a>
                            @elseif($isTaker)
                                <a href="{{ route('friendsCancelRequest',['user' => $user->id]) }}" class="card-link">Отменить запрос</a>
                            @else
                                <a href="{{ route('friendsSendRequest',['user' => $user->id]) }}" class="card-link">Отправить запрос</a>
                            @endif
                        @endif

                    @endif
                </div>
            </div>
        </div>

    @endforeach
    </div>

    <div class="row">
        {{ $users->render() }}

    </div>
@endsection
