<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlatoSegundo extends Model
{
    use SoftDeletes;
    protected $table = 'plato_segundo';
}
