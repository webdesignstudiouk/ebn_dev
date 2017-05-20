<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kodeine\Metable\Metable;

class Client extends Model
{
	use Metable;
    protected $guarded = [];
	protected $table = "clients";
	protected $metaTable = 'clients_meta';

	/**
	 * Get the contacts assigned to this client;
	 */
	public function contacts()
	{
	    return $this->hasMany('App\Client_Contacts');
	}

	/**
	 * Get the contacts assigned to this client;
	 */
	public function portfolio()
	{
	    return $this->hasMany('App\Clients_Portfolio');
	}

	/**
	 * Get the contacts assigned to this client;
	 */
	public function projects()
	{
			return $this->hasMany('App\Clients_Portfolio');
	}

	public function users()
	{
			return $this->belongsToMany('App\User', 'relations_clients_users');
	}
}
