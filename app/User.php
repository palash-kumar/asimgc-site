<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password', 'uuid','com_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // creating Many-To-One relation with the users UserRoles table 
    public function userRole(){
        
        return $this->belongsTo('App\Models\AppModels\UserRoles', 'user_roles_id');
    }

    // creating Many-To-One relation with the users UserRoles table 
    public function designation(){
        
        return $this->belongsTo('App\Models\AppModels\Designations', 'designations_id');
    }

    // creating One-To-Many relation with the UsersServices table 
    public function userServices(){
        return $this->hasMany('App\Models\AppModels\UserServices');
    }

}
