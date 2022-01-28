<?php

namespace App\Http\Controllers\Administracion;

use App\Detalleordenservicio;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DetalleOrdenServicioController extends Controller
{
    public function view(Request $request){

        $dato = Detalleordenservicio::with('ordenservicio','unidmedida','producto', 'producto.marca', 'producto.familia', 'producto.material', 'producto.modelotipo', 'producto.subfamilia')->where('ordenservicio_id', $request->item)->get();
        return $dato;
    }
}
