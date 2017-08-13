<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Suppliers extends Model {
    use SoftDeletes;
    use Searchable;
}

?>
