<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProspectsCallbacks extends Model {
	use SoftDeletes;

	protected $dates = ['deleted_at'];
    protected $guarded = [];

	public function author(){
       return $this->belongsTo('App\Models\Users', 'author_id');
    }

	public function prospect(){
       return $this->belongsTo('App\Models\Prospects', 'prospect_id');
  }

	public function prospectNonDeletes(){
       return $this->belongsTo('App\Models\Prospects', 'prospect_id')->whereNull('deleted_at');
  }
}

?>
