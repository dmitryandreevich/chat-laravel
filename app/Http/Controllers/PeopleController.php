<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeopleController extends Controller
{
    public function index(){
        $allUsers = User::paginate(6);
        return view('people',[ 'users' => $allUsers ] );
    }
}
