<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clients_Project_Bugs_Updates extends Model
{
  protected $guarded = [];
	protected $table = "clients_project_bugs_updates";

  public function author(){
      return $this->belongsTo('App\User', 'author_id');
  }

  public function bug(){
      return $this->belongsTo('App\Clients_Project_Bugs', 'bug_id');
  }
}
