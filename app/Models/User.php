<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\ProspectsCallbacks;
use App\Models\Prospects;
use Auth;
use Illuminate\Support\Collection;


class User extends Authenticatable
{
    use Notifiable;

    protected $guarded = [];

    public function prospects(){
       return $this->hasMany('App\Models\Prospects', 'user_id');
    }
}
