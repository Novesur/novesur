<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleMenu extends Model
{
    protected $table = 'detallemenu';

    public function menu(){
        return $this->belongsTo(Menu::class);
    }

    public function menuentrada()
    {
        return $this->belongsTo(MenuEntrada::class);
    }

    public function menusegundo()
    {
        return $this->belongsTo(MenuSegundo::class);
    }

    public function menuextra()
    {
        return $this->belongsTo(MenuExtra::class);
    }

    public function tipomenu()
    {
        return $this->belongsTo(TipoMenu::class);
    }
}
