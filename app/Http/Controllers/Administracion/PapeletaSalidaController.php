<?php

namespace App\Http\Controllers\Administracion;

use App\Cliente;
use App\Detallepapeletasalida;
use App\Http\Controllers\Controller;
use App\Motivopapeletasalida;
use App\Papeletasalida;
use Illuminate\Http\Request;
use Carbon\Carbon;
use PDF;

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
        $PapeletaSalida->estadopapeletasalida_id = '1';
        $PapeletaSalida->save();

        $detallePsalida = new Detallepapeletasalida;
        $detallePsalida->papeletasalida_id = $PapeletaSalida->id;

        if($request->nIdMotivo == 3){

            $detallePsalida->cliente_id = $request->nIdCliente;
        }else{
            $detallePsalida->cliente_id = 202;
        }


        $detallePsalida->contacto = mb_strtoupper($request->cContacto);
        $detallePsalida->fundamento = mb_strtoupper($request->cReferencia);
        $detallePsalida->save();
        return response()->json(['message' => 'Grabado', 'icon' => 'success'], 200);

    }

    public function listPapeleByVendedor(Request $request){

        $dFechainicio = date("Y-m-d", strtotime($request->dFechainicio));
        $dFechafin = date("Y-m-d", strtotime($request->dFechafin));


        if($request->nIdMotivo == null && $request->dFechafin == null &&  $request->nIdVendedor == null && $request->dFechainicio == null){
            $dato = Papeletasalida::with('user','estadoPapeletaSalida')->get();
            return $dato;
        }
        if($request->nIdMotivo == null){
                $dato = Papeletasalida::with('user','estadoPapeletaSalida')->where('user_id', $request->nIdVendedor)->whereBetween('fecha',[$dFechainicio, $dFechafin])->get();
                return $dato;
            }

            if($request->dFechainicio == null && $request->dFechafin == null  ){
                $dato = Papeletasalida::with('user','estadoPapeletaSalida')->where('user_id', $request->nIdVendedor)->where('motivopapeletasalida_id', $request->nIdMotivo)->get();
                return $dato;
            }


    }

    public function listPapeleByCliente(Request $request){

            $dato = Detallepapeletasalida::with('papeletasalida','cliente','papeletasalida.user')->where('cliente_id', $request->nIdClient)->get();
            return $dato;
    }

    public function ListMotivos(){
        $dato = Motivopapeletasalida::all();
        return $dato;
    }

    public function ListPapeletaSalidabyId(Request $request)
    {

        $dato = Papeletasalida::where('id', $request->item)->first();
        return $dato;
    }

    public function PapeletasalidaPdf(Request $request)
    {

        $idPapeletaS = $request->get("params")['item'];

        $parteSalida = Papeletasalida::with('user','motivopapeletasalida','estadoPapeletaSalida')->where('id',$idPapeletaS)->first();

        $detalleParteSalida = Detallepapeletasalida::with('papeletasalida','cliente')->where('papeletasalida_id',$idPapeletaS)->first();
        $logo = asset('img/logo.gif');
        $productos01 = asset('img/banner01.png');
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('reporte.parteSalida.reporte', [
            'logo' => $logo,
            'productos01' => $productos01,
            'parteSalida' => $parteSalida,
            'detalleParteSalida' => $detalleParteSalida,
        ]);
        return $pdf->download('invoice.pdf');

        }

        public function setDarBajaPapeletaSalida(Request $request){


        $papeletaS = Papeletasalida::find($request->item);
           $papeletaS->estadopapeletasalida_id = 2;
            $papeletaS->save();

        }

        public function setAprobarPapeletaSalida(Request $request){
            $papeletaS = Papeletasalida::find($request->item);
            $papeletaS->estadopapeletasalida_id = 3;
             $papeletaS->save();

        }

        public function getListarCliente(Request $request)
        {
            $dato = Cliente::where('usuario_id', $request->nIdVendedor)->orWhere('usuario_id', 1)->get();
            return $dato;
        }
}
