<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Bican\Roles\Traits\HasRoleAndPermission;
use Bican\Roles\Contracts\HasRoleAndPermission as HasRoleAndPermissionContract;
use Bican\Roles\Models\Role;
use Kodeine\Metable\Metable;
use App\Client;
use Auth;

class User extends Authenticatable implements HasRoleAndPermissionContract
{
	use HasRoleAndPermission, Notifiable, Metable;

	protected $guarded = [];
	protected $metaTable = 'users_meta';

   //public function __construct(){
	    //Role::create(['name' => 'Admin', 'slug' => 'admin', 'description' => '', 'level' => 1, ]);
		//Role::create(['name' => 'Client', 'slug' => 'client',]);
		//Role::create(['name' => 'User', 'slug' => 'user',]);
   //}
	public function clients()
	{
	    return $this->belongsToMany('App\Client', 'relations_clients_users');
	}
}
