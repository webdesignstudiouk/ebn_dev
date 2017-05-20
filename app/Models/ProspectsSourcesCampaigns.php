<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProspectsSourcesCampaigns extends Model {
	use SoftDeletes;
	
	protected $dates = ['deleted_at'];
    protected $guarded = [];
	
	public function source(){
       return $this->belongsTo('App\Models\ProspectsSources', 'source_id');
    }
}

?>
