<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clients_Project_Bugs extends Model
{
  protected $guarded = [];
	protected $table = "clients_project_bugs";

  /**
   * Get the portfolio author.
   */
  public function updates()
  {
      return $this->hasMany('App\Clients_Project_Bugs_Updates', 'bug_id')->orderBy('created_at', 'desc');
  }

  public function user()
  {
      return $this->hasMany('App\Clients_Portfolio_Meta', 'bug_id')->orderBy('created_at', 'desc');
  }

  public function project()
  {
      return $this->belongsTo('App\Clients_Portfolio', 'project_id');
  }
}
