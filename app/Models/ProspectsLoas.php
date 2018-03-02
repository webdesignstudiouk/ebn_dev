<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProspectsLoas extends Model {
	use SoftDeletes;

	protected $table = "prospects_loas";
	protected $guarded = [];

	public function author(){
		return $this->belongsTo('App\Models\Users', 'author_id');
	}

	public function prospect(){
		return $this->belongsTo('App\Models\Prospects', 'prospect_id');
	}
}

?>
