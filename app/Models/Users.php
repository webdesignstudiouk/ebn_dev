<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Users extends Model {
	use SoftDeletes;

	protected $dates = ['deleted_at'];
    protected $guarded = [];

    public function prospects(){
       return $this->hasMany('App\Models\Prospects', 'user_id');
    }

    public function prospects1(){
       return $this->hasMany('App\Models\Prospects', 'user_id')->where('type_id', '1');
    }

    public function prospects2(){
       return $this->hasMany('App\Models\Prospects', 'user_id')->where('type_id', '2');
    }

    public function clients(){
       return $this->hasMany('App\Models\Prospects', 'user_id')->where('type_id', '3');
    }

    public function prospect(){
        return $this->belongsTo('App\Models\Prospects', 'prospect_id');
    }

    public function group(){
        return $this->belongsTo('App\Models\Users_Groups', 'group_id');
    }
}

?>
