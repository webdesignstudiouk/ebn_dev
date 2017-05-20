<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Products_Meta extends Model
{
    protected $guarded = [];
	protected $connection = 'store'; 
	protected $table = "products_meta"; 
}

