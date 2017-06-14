<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Users_Groups extends Model {
    protected $table = 'users_groups';
    protected $guarded = [];
    public $timestamps = false;

    public function users(){
        return $this->hasMany('App\Models\Users', 'group_id');
    }
}

?>
