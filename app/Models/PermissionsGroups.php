<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class PermissionsGroups extends Eloquent {
    protected $table = "permission_groups";
    protected $guarded = [];
    public $timestamps = false;
}

?>
