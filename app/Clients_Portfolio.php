<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kodeine\Metable\Metable;

class Clients_Portfolio extends Model
{
	use Metable;
    protected $guarded = [];
	protected $table = "clients_portfolio";
	protected $metaTable = 'clients_portfolio_meta';

	/**
	 * Get the portfolio author.
	 */
	public function bugs()
	{
			return $this->hasMany('App\Clients_Project_Bugs', 'project_id')->orderBy('id', 'desc');
	}

	/**
	 * Get the service portfolio assigned to.
	 */
	public function service()
	{
	    return $this->belongsTo('App\Service');
	}

	/**
	 * Get the client portfolio assigned to.
	 */
	public function client()
	{
	    return $this->belongsTo('App\Client');
	}

	/**
	 * Get the portfolio author.
	 */
	public function author()
	{
	    return $this->belongsTo('App\User', 'author_id');
	}
}
