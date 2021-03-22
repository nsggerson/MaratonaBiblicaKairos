<?php

namespace App\Models;

use Core\BaseModel;
use Core\BaseModelEloquent;

//class User extends BaseModelEloquent
class User extends BaseModel
{

    //public $table = "users";
    protected $table = "users";
    /*
    public $timestamps = false;

    protected $fillable = ['name','registrationNumber', 'email', 'password','currentDateAndTime'];

    public function rulesCreate(){
        return [
            'name' => 'min:4|max:255',
            'registrationNumber' => 'registrationNumber|unique:User:registrationNumber',
            'email' => 'email|unique:User:email',
            'password' => 'min:6|max:16',
            'currentDateAndTime' =>'min:6|max:20'
        ];
    }

    public function rulesUpdate($id)
    {
        return [
            'name' => 'min:4|max:255',
            'registrationNumber' => "registrationNumber|unique:User:registrationNumber:$id",
            'email' => "email|unique:User:email:$id",
            'password' => 'min:6|max:16',
            'currentDateAndTime' =>'min:6|max:20'
        ];
    }

    public function post()
    {
        return $this->hasMany(Post::class);
    }*/

}