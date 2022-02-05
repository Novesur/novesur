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

    public function motivopapeletasalida()
    {
        return $this->belongsTo(Motivopapeletasalida::class);
    }

    public function estado()
    {
        return $this->belongsTo(Estadoprod::class);
    }
}
