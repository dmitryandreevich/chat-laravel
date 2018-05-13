<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Publication extends Model
{
    protected $fillable = ['author_id','text'];
    public static function getAll($author_id){
        return Publication::where('author_id',$author_id)->orderBy('created_at','desc')->get();
    }
}
