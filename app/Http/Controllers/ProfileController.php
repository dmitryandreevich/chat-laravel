<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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

    public function changeAvatar(Request $request){
        if($request->has('avatar')){
            $file = $request->file('avatar');
            $fileBytes = file_get_contents($file);

            $fileName = time() . '_' . Auth::user()->id . '_' . $file->getClientOriginalName();

            Storage::disk('local')->put("public/avatars/$fileName", $fileBytes);
            $fileURI = asset("storage/avatars/$fileName");
            $user = User::find(Auth::user()->id);
            $user->avatar = $fileName;
            $user->save();

            echo "<img src='$fileURI'>   </img>";

        }

    }
}
