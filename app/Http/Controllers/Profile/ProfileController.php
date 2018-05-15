<?php

namespace App\Http\Controllers\Profile;

use App\Friend;
use App\FriendRequest;
use App\Http\Controllers\FriendsController;
use App\Publication;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index(){
        $user = Auth::user();
        $friends = FriendsController::getAllFriends($user->id);
        $publications = Publication::getAll($user->id);

        return view('profile.profile',[
            'user' => $user,
            'publications' => $publications,
            'friends' => $friends
        ]);
    }
    public function show(User $user){
        $publications = Publication::getAll($user->id);
        $friends = FriendsController::getAllFriends($user->id);
        return view('profile.showProfile',[
            'user' => $user,
            'publications' => $publications,
            'friends' => $friends
        ]);
    }
}
