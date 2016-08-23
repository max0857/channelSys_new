<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class users extends Authenticatable
{
    //

//    protected $table = 'users';
//
//    protected $fillable = [
//        'username',
//        'password',
//    ];

    protected $dates = [

    ];

//    public  function setUsernameAttribute($data)
//    {
//        $this->attributes['username']=$data.'test';
//
//    }

    public function scopeCheckUsername($query,$username){
        return $query->where('username','=',$username);
    }

    public function scopeToday($query){

//        $query->where('join_time','=',Carbon::today());
    }

}
//
//$tt=new users;
//$tt->name='pengyankai';
//$tt->save();
