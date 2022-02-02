<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detallepapeletasalida extends Model
{
    protected $table = 'detallepapeletasalida';


    public function papeletasalida()
    {
        return $this->belongsTo(Papeletasalida::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

}
