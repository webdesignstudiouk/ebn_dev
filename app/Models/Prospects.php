<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Prospects extends Model {
	use SoftDeletes;
	use Searchable;

	protected $dates = ['deleted_at'];
	protected $guarded = [];
	protected $casts = [
    'vervalCED' => 'date'
  ];

	public function searchableAs(){
		return 'prospects_index';
	}

	public function toSearchableArray(){
	  $array = $this->toArray();
	  return $array;
	}

	public function user(){
		return $this->belongsTo('App\Models\Users', 'user_id');
	}

	public function source(){
		return $this->belongsTo('App\Models\ProspectsSources', 'source_id');
	}

	public function campaign(){
		return $this->belongsTo('App\Models\ProspectsSourcesCampaigns', 'campaign_id');
	}

	public function prospectType(){
		return $this->belongsTo('App\Models\ProspectsTypes', 'type_id');
	}

	public function callbacks(){
		return $this->hasMany('App\Models\ProspectsCallbacks', 'prospect_id')->orderBy('id', 'desc');
	}

	public function callbacksWithTrashed(){
		return $this->hasMany('App\Models\ProspectsCallbacks', 'prospect_id')->withTrashed()->orderBy('id', 'desc');
	}

	public function contacts(){
		return $this->hasMany('App\Models\Contacts', 'prospect_id');
	}

	public function sites(){
		return $this->hasMany('App\Models\Sites', 'prospect_id');
	}

}

?>
