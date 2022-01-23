<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parteingreso extends Model
{
    protected $table = 'parteingreso';

    protected $fillable =[
        'proveedor_id',
        'Nrofactura',
        'Nroguia',
        'motivo_id',
        'Fecha',
        'observacion',
        'user_id',
        'estadoparte_id',

    ];


    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }

    public function motivo()
    {
        return $this->belongsTo(Motivo::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}

