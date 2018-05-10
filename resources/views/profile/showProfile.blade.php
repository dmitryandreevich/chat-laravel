@extends('layouts.app')

@section('content')
    @php if(!isset($user)) die('not found') @endphp
    <div class="row">
        <div class="col-md-4">
            <img src="{{ asset("storage/avatars/$user->avatar") }}" alt="" class="card-img-top photo-profile">
        </div>
        <div class="col-md-6 offset-md-2">
            <div class="card">

                <div class="card-header">{{ "{$user->name} {$user->secondName} {$user->middleName}"}}</div>
                <div class="card-body">
                    <p>id: <span class="badge badge-info">{{ $user->id }}</span></p>

                    <p>Страна-город: <span class="badge badge-info">{{ "{$user->country} - {$user->city}" }}</span></p>

                    <p>Телефон: <span class="badge badge-info">{{ $user->phoneNumber }}</span></p>
                </div>
            </div>
        </div>

    </div>

@endsection