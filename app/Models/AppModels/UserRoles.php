<?php

namespace App\Models\AppModels;

use Illuminate\Database\Eloquent\Model;

class UserRoles extends Model
{
    //
    // creating One-To-Many relation with the users Gallery table 
    public function users(){
        return $this->hasMany('App\User');
    }
}
