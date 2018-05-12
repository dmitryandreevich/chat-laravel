<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrivateChatController extends Controller
{
    public function show($id){
        return view('chat.private.chat',[
            'user' => Auth::user(),
            'companion' => User::find($id)
        ]);
    }
}
