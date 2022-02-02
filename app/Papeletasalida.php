<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Papeletasalida extends Model
{
    protected $table = 'papeletasalida';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
