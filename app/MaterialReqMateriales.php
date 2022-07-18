<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MaterialReqMateriales extends Model
{
    protected $table = 'material_reqmateriales';


    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
    public function unidmedida()
    {
        return $this->belongsTo(UnidMedida::class);
    }
}
