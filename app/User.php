<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {
    public function posts(){
        return $this -> hasMany('App\Post');
    }
}

