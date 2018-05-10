<?php

namespace App\Http\Controllers\Profile;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function index(){
        return view('profile.profile');
    }

    public function show(User $user){
        return view('profile.showProfile',[
            'user' => $user
        ]);
    }
}
