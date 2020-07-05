<?php

namespace App\Models\AppModels;

use Illuminate\Database\Eloquent\Model;

class ImageCategory extends Model
{
    // creating One-To-Many relation with the users Gallery table 
    public function gallery(){
        return $this->hasMany('App\Models\AppModels\Gallery');
    }
}
