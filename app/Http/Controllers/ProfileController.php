<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

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
