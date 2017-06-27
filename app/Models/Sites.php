<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sites extends Model {
	use SoftDeletes;
	
	protected $dates = ['deleted_at'];
    protected $guarded = [];

    public function prospect(){
       return $this->belongsTo('App\Models\Prospects', 'prospect_id');
    }

	public function electricMeters(){
       return $this->hasMany('App\Models\ElectricMeters', 'site_id')->orderBy('ContractEndDate', 'desc');
    }

	public function gasMeters(){
       return $this->hasMany('App\Models\GasMeters', 'site_id')->orderBy('ContractEndDate', 'desc');
    }
}

?>
