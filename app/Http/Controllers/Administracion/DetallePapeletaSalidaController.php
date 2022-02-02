<?php

namespace App\Http\Controllers\Administracion;

use App\Detallepapeletasalida;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DetallePapeletaSalidaController extends Controller
{
    public function BuscaDetallePapeletaS(Request $request){

       $dato =  Detallepapeletasalida::with('cliente')->where('papeletasalida_id', $request->item)->get();
       return $dato;


    }
}
