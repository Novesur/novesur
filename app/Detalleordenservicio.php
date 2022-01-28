<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detalleordenservicio extends Model
{
    protected $table = 'detalleordenservicio';

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
