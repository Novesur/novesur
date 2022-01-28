<?php

namespace App\Http\Controllers\Administracion;

use App\Detallepapeletasalida;
use App\Http\Controllers\Controller;
use App\Motivopapeletasalida;
use App\Papeletasalida;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PapeletaSalidaController extends Controller
{
    public function Motivo(){
        $motivo = Motivopapeletasalida::all();
        return $motivo;
    }

    public function create( Request $request){

        $PapeletaSalida = new Papeletasalida;
        $PapeletaSalida->user_id = $request->nIdUser;
        $PapeletaSalida->fecha = Carbon::parse($request->cFecha)->format('Y-m-d');
        $PapeletaSalida->horasalida = substr($request->tHoraSalida,0,8);
        $PapeletaSalida->horaretorno = substr($request->tHoraRetorno,0,8);
        $PapeletaSalida->motivopapeletasalida_id = $request->nIdMotivo;
        $PapeletaSalida->estado_id = '1';
        $PapeletaSalida->save();

        $detallePsalida = new Detallepapeletasalida;
        $detallePsalida->papeletasalida_id = $PapeletaSalida->id;
        $detallePsalida->cliente_id = $request->nIdCliente;
        $detallePsalida->contacto = mb_strtoupper($request->cContacto);
        $detallePsalida->fundamento = mb_strtoupper($request->cReferencia);
        $detallePsalida->save();
        return response()->json(['message' => 'Grabado', 'icon' => 'success'], 200);

    }

    public function listPapeleByVendedor(Request $request){

        $dFechainicio = date("Y-m-d", strtotime($request->dFechainicio));
        $dFechafin = date("Y-m-d", strtotime($request->dFechafin));


        if($request->nIdMotivo == null){
                $dato = Papeletasalida::where('user_id', $request->nIdVendedor)->whereBetween('fecha',[$dFechainicio, $dFechafin])->get();
                return $dato;
            }
    }

    public function ListMotivos(){
        $dato = Motivopapeletasalida::all();
        return $dato;
    }
}
