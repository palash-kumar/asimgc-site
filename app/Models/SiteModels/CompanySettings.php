<?php

namespace App\Models\SiteModels;

use Illuminate\Database\Eloquent\Model;

class CompanySettings extends Model
{

    private $com_id = '';
    private $title='';
    private $description = '';
    private $logo = '';

    /*function setTitle($title){
        $this->$title = $title;
    }

    function getTitle(){
        return $title;
    }

    function setDescription($description){
        $this->$description = $description;
    }

    function getDescription(){
        return $description;
    }*/
}
