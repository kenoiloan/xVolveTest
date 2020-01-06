<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    //
    public function getData($gender){
        return Users::where('gender', $gender)->get()->toArray();
    }
}
