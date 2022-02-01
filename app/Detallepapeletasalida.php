<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detallepapeletasalida extends Model
{
    protected $table = 'detallepapeletasalida';

    public function ordenservicio()
    {
        return $this->belongsTo(Ordenservicio::class);
    }

    public function unidmedida()
    {
        return $this->belongsTo(UnidMedida::class);
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}
