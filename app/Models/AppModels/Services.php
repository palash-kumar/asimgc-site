<?php

namespace App\Models\AppModels;

use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    // creating One-To-Many relation with the UsersServices table 
    public function userServices(){
        return $this->hasMany('App\Models\AppModels\UserServices');
    }
}
