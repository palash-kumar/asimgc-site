<?php

namespace App\Models\AppModels;

use Illuminate\Database\Eloquent\Model;

class UserServices extends Model
{
    // creating Many-To-One relation with the User table 
    public function user(){
        
        return $this->belongsTo('App\User');
    }

    // creating Many-To-One relation with the users UserRoles table 
    public function services(){
        
        return $this->belongsTo('App\Models\AppModels\Services');
    }
}
