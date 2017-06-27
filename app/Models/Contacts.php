<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contacts extends Model {
	use SoftDeletes;
	
	protected $dates = ['deleted_at'];
    protected $guarded = [];

	public function type(){
       return $this->belongsTo('App\Models\ContactsTypes', 'type_id');
    }

    public function user(){
       return $this->belongsTo('App\Models\Users', 'author_id');
    }
	
	public function prospect(){
       return $this->belongsTo('App\Models\Prospects', 'prospect_id', 'id');
    }
}

?>
