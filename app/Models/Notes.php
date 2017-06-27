<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Notes extends Eloquent {
  protected $guarded = [];
  public $timestamps = false;

  public function author(){
     return $this->belongsTo('App\Models\Users', 'agentId', 'userId');
  }

  public function user(){
     return $this->belongsTo('App\Models\Users', 'userId', 'userId');
  }

}

?>
