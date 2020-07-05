<?php

namespace App\Models\AppModels;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    // creating Many-To-One relation with the users ImageCategory table 
    public function imageCategory(){
        
        return $this->belongsTo('App\Models\AppModels\ImageCategory');
    }
}
