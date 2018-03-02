<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
use Illuminate\Notifications\Notifiable;


class Prospects extends Model {
	use SoftDeletes;
	use Searchable;
	use Notifiable;

	protected $dates = ['deleted_at'];
	protected $guarded = [];
	protected $casts = [
    'vervalCED' => 'date'
  ];

	public function getTableColumns() {
		return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
	}

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

	public function archived_loas(){
		return $this->hasMany('App\Models\ProspectsLoas', 'prospect_id')->where('active', '!=','1')->orderBy('sent', 'desc');
	}

	public function current_loa(){
		return $this->hasOne('App\Models\ProspectsLoas', 'prospect_id')->where('active', '1');
	}

	public function favourite_contact(){
		return $this->hasOne('App\Models\Contacts', 'prospect_id')->where('favourite', '=', '1');
	}

	public function sites(){
		return $this->hasMany('App\Models\Sites', 'prospect_id');
	}

    public function typeTitle(){
        if($this->type_id == 1){
            $typeTitle = "Prospect";
        }elseif($this->type_id == 2){
            $typeTitle = "Prospect 2";
        }elseif($this->type_id == 3){
            $typeTitle = "Client";
        }else{
            $typeTitle = "";
		}
        return $typeTitle;
    }

}

?>
