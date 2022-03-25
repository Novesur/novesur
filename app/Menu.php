<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menu';

    protected $fillable =[
        'user_id',
        'fecha',
        'hora',
        'tipomenu_id',
        'observacion',
    ];

    public function tipomenu()
    {
        return $this->belongsTo(TipoMenu::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
