<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ElectricMeters extends Model {
	use SoftDeletes;

	protected $table = "sites_electricMeters";
	protected $dates = ['deleted_at'];
    protected $guarded = [];

    public function site(){
       return $this->belongsTo('App\Models\Sites', 'site_id');
    }

}

?>

