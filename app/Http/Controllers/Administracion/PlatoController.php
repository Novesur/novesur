<?php

namespace App\Http\Controllers\Administracion;

use App\DetallePlato;
use App\Http\Controllers\Controller;
use App\PedidoEntrada;
use App\PlatoEntrada;
use App\PlatoExtra;
use App\PlatoSegundo;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PlatoController extends Controller
{
    public function CrearPlatoEntrada(Request $request)
    {
        $platoEntCount = PlatoEntrada::where('nombre', $request->cNomEntrada)->count();

        if ($platoEntCount <=  0) {
            $platoEntrada = new PlatoEntrada;
            $platoEntrada->nombre = mb_strtoupper(trim($request->cNomEntrada));
            $platoEntrada->estado = 'A';
            $platoEntrada->save();
            return response()->json(['message' => 'Plato Entrada Agregado', 'icon' => 'info'], 200);
        } else {
            return response()->json(['message' => 'El Plato Entrada ya existe', 'icon' => 'warning'], 200);
        }
    }

    public function CrearPlatoSegundo(Request $request)
    {
        $platoSegCount = PlatoSegundo::where('nombre', $request->cNomSegundo)->count();

        if ($platoSegCount <=  0) {
            $platoSegundo = new PlatoSegundo();
            $platoSegundo->nombre = mb_strtoupper(trim($request->cNomSegundo));
            $platoSegundo->estado = 'A';
            $platoSegundo->save();
            return response()->json(['message' => 'Plato Segundo Agregado', 'icon' => 'info'], 200);
        } else {
            return response()->json(['message' => 'El Plato Segundo ya existe', 'icon' => 'warning'], 200);
        }
    }

    public function CrearPlatoExtra(Request $request)
    {
        $platoExtCount = PlatoExtra::where('nombre', $request->cNomExtra)->count();

        if ($platoExtCount <=  0) {
            $platoExtra = new PlatoExtra();
            $platoExtra->nombre = mb_strtoupper(trim($request->cNomExtra));
            $platoExtra->estado = 'A';
            $platoExtra->save();
            return response()->json(['message' => 'Plato Extra Agregado', 'icon' => 'info'], 200);
        } else {
            return response()->json(['message' => 'El Plato Extra ya existe', 'icon' => 'warning'], 200);
        }
    }

    public function getListarPEntrada(Request $request)
    {
        if ($request->cNombre == NULL) {
            $dato = PlatoEntrada::where('estado', 'A')->get();
            return $dato;
        } else {
            $dato = PlatoEntrada::where('nombre', $request->cNombre)->orWhere('estado', 'A')->get();
            return $dato;
        }
    }

    public function getListarPSegundo(Request $request)
    {

        if ($request->cNombre == NULL) {
            $dato = PlatoSegundo::where('estado', 'A')->get();
            return $dato;
        } else {
            $dato = PlatoSegundo::where('nombre', $request->cNombre)->orWhere('estado', 'A')->get();
            return $dato;
        }
    }

    public function getListarPExtra(Request $request)
    {

        if ($request->cNombre == NULL) {
            $dato = PlatoExtra::where('estado', 'A')->get();
            return $dato;
        } else {
            $dato = PlatoExtra::where('nombre', $request->cNombre)->orWhere('estado', 'A')->get();
            return $dato;
        }
    }


    public function CreateDetallePlato(Request $request)
    {

        $detallePlato = new DetallePlato;
        $detallePlato->plato_id = $request->nidPlato;
        $detallePlato->tipoplato_id = $request->tipoPlato;
        $detallePlato->fecha =  Carbon::parse($request->dFecha)->format('Y-m-d');
        $detallePlato->save();
        return response()->json(['message' => 'Pedido de plato agregado', 'icon' => 'info'], 200);
    }

    public function listEntrada(){
        $dato = PlatoEntrada::where('estado', 'A')->get();
            return $dato;
    }



    public function listSegundo(){
        $dato = PlatoSegundo::where('estado', 'A')->get();
        return $dato;

    }

    public function listExtra(){
        $dato = PlatoExtra::where('estado', 'A')->get();
        return $dato;
    }
}
