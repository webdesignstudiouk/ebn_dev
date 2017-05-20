<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kodeine\Metable\Metable;

class Products extends Model
{
	use Metable;
    protected $guarded = [];
    protected $connection = 'store';
	protected $table = "products";
	protected $metaTable = 'products_meta';
	
	public function category(){
		return $this->belongsTo('App\Product_Categories');	
	}
}
