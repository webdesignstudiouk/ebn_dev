<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProspectsSources extends Model {
	use SoftDeletes;
	
	protected $dates = ['deleted_at'];
    protected $guarded = [];
	
	public function campaigns(){
       return $this->hasMany('App\Models\ProspectsSourcesCampaigns', 'source_id');
    }
}

?>
