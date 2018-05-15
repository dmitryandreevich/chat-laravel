<?php

namespace App\Http\Controllers;

use App\MessageHistory;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrivateChatController extends Controller
{
    public function show($id){
        $user = Auth::user();
        $companion = User::find($id);

        $history = MessageHistory::whereRaw('(sender = ? and receiver = ?) or (sender = ? and receiver = ?)', [$user->id, $companion->id, $companion->id, $user->id])->get();
        // если отправитель сообщения не является тем, к кому в лс заходит пользователь
        // значит имя отправителя == имени того, кто отправил запрос на вход в личные сообщения
        foreach ($history as $msg)
            $msg->firstname = $msg->sender != $id ? $user->name : $companion->name;

        return view('chat.private.chat',[
            'user' => $user,
            'companion' => $companion,
            'history' => $history
        ]);
    }
}
