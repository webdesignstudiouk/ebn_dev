<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Core_Colours extends Model {
	use SoftDeletes;

	protected $table = "core_colours";
	protected $dates = ['deleted_at'];
    protected $guarded = [];
}

?>

