<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrivateChatController extends Controller
{
    public function show(){
        return view('chat.private.chat');
    }
}
