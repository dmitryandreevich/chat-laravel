<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MessageHistory extends Model
{
    //
    protected $fillable = ['sender', 'receiver', 'text'];
}
