<?php

namespace App\Http\Controllers;

use App\Friend;
use App\FriendRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FriendsController extends Controller
{
    public function index(){
        $friends = $this->getAllFriends(Auth::user()->id);
        return view('friends.allFriends', compact('friends'));
    }
    public function requests(){
        $requests = $this->getAllRequests(Auth::user()->id);
        return view('friends.allRequests',compact('requests'));
    }
    // Был ли запрос отправлен от одного юзера до другого или наоборот
    public static function requestWouldSend($userId1, $userId2){
        $count = FriendRequest::whereRaw('sender = ? and taker = ? or sender = ? and taker = ?',[$userId1, $userId2,$userId2,$userId1])->count();
        return $count >= 1;
    }
    // получить статус запроса, отправитель этот юзер или получатель
    public static function getRequestType($userId){
        $authUId = Auth::user()->id;
        $request = FriendRequest::whereRaw('sender = ? and taker = ? or sender = ? and taker = ?',
            [$authUId, $userId, $userId, $authUId])->get();
        if(count($request) != 0){
            if($request[0]->sender === $userId) return array('sender',$request[0]->status);
            if($request[0]->taker === $userId) return array('taker',$request[0]->status);
        }
        return false;
    }
    public static function isSub($userId){
        return self::getRequestType($userId)[0] === 'sender';
    }
    public static function isTaker($userId){
        return self::getRequestType($userId)[0] === 'taker';
    }
    public static function isFriend($userId){
        return self::getRequestType($userId)[1] === 1;
    }
    // отправка запроса дружбы пользователю
    public function sendRequest(User $user){
        $req = FriendRequest::firstOrCreate(['sender' => Auth::user()->id, 'taker' => $user->id,'status' => 0]);
        return redirect(route('people'));
    }
    // подтверждение запроса
    public function acceptRequest(User $user){
        $request = FriendRequest::whereRaw('sender = ? and taker = ? or sender = ? and taker = ?',[Auth::user()->id,$user->id,$user->id,Auth::user()->id])->update(['status' => 1]);

        Friend::firstOrCreate(['id1' => Auth::user()->id, 'id2' => $user->id]);

        Friend::firstOrCreate(['id1' => $user->id, 'id2' => Auth::user()->id]);

        return redirect(route('people'));
    }
    // отмена/удаление друга
    public function cancelRequest(User $user){
        $request = FriendRequest::whereRaw('sender = ? and taker = ? or sender = ? and taker = ?',[Auth::user()->id,$user->id,$user->id,Auth::user()->id])->delete();
        Friend::whereRaw('id1 = ? and id2 = ?',[Auth::user()->id, $user->id])->delete();

        Friend::whereRaw('id1 = ? and id2 = ?',[$user->id, Auth::user()->id])->delete();

        return redirect(route('people'));
    }
    // получить количество друзей юзера
    public static function getCountFriends($userId){
        return Friend::whereRaw('id1 = ?',[$userId])->count();
    }
    // получить всех друзей юзера
    private function getAllFriends($userId){
        $friendsIds = Friend::whereRaw('id1 = ?',[$userId])->get();
        $friends = array();
        foreach ($friendsIds as $friend){
            $user = User::find($friend->id2);
            array_push($friends,$user);
        }
        return $friends;
    }
    // получить все запросы юзера, где он получатель
    private function getAllRequests($userId){
        $requestsIds = FriendRequest::whereRaw('taker = ? and status = 0',[$userId])->get();
        $users = array();
        foreach ($requestsIds as $request){
            $user = User::find($request->sender);
            array_push($users,$user);
        }
        return $users;
    }
}
