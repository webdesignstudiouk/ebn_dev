<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Bican\Roles\Traits\HasRoleAndPermission;
use Bican\Roles\Contracts\HasRoleAndPermission as HasRoleAndPermissionContract;
use Bican\Roles\Models\Role;
use Auth;


class User extends Authenticatable implements HasRoleAndPermissionContract
{
    use HasRoleAndPermission, Notifiable;

    protected $guarded = [];

    public function prospects(){
       return $this->hasMany('App\Models\Prospects', 'user_id');
    }

    public function group(){
        return $this->belongsTo('App\Models\Users_Groups', 'group_id');
    }
}

