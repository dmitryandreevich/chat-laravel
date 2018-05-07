<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PeopleController extends Controller
{
    public function index(){
        $allUsers = User::paginate(6);
        /*foreach ($allUsers as $user){
            if(FriendsController::requestWouldSend(Auth::user()->id, $user->id)){
                $request = FriendsController::getRequest(Auth::user()->id, $user->id);
                $user->isSub = $request->sender == $user->id;
                $user->isTaker = $request->taker == $user->id;
            }
        }*/
        return view('people',[ 'users' => $allUsers ] );
    }
}
