<?php

namespace App\Http\Controllers\Profile;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UpdateController extends Controller
{
    protected $redirectTo = '/';
    public function index(){
        return view('profile.update');
    }
    public function update(Request $request){
        $request->validate([
            'name' => 'required|string|max:25',
            'secondName' => 'required|string|max:30',
            'middleName' => 'required|string|max:30',
            'aboutMe' => 'required|string|min:5',
            'email' => 'required|email|min:5'
        ]);
        $data = $request->input();
        Auth::user()->update(['name' => $data['name'],
            'secondName' => $data['secondName'],
            'middleName' => $data['middleName'],
            'phoneNumber' => $data['phoneNumber'],
            'aboutMe' => $data['aboutMe'],
            'email' => $data['email'],
            'country' => $data['country'],
            'city' => $data['city'],
            'sex' => $data['sex']]);
        return redirect( route('profile') );
    }
    public function updateAvatar(Request $request){
        if($request->has('avatar')){
            $file = $request->file('avatar');
            $fileBytes = file_get_contents($file);
            $fileName = time() . '_' . Auth::user()->id . '_' . $file->getClientOriginalName();
            Storage::disk('local')->put("public/avatars/$fileName", $fileBytes);
            $user = User::find(Auth::user()->id);
            $user->avatar = $fileName;
            $user->save();

            return redirect( route('profileUpdatePage') );
        }
    }
}
