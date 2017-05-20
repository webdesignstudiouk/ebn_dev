<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $guarded = [];
	protected $table = "images";
	
	/**
	* Get the contacts assigned to this client;
	*/
	public function sizesAvailable()
	{
	    return $this->hasMany('App\Image_Sizes');
	}
}
