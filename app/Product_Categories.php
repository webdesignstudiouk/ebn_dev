<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_Categories extends Model
{
    protected $guarded = [];
    protected $connection = 'store';
	protected $table = "product_categories";
}
