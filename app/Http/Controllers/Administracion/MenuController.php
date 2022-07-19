<?php

namespace App\Http\Controllers\Administracion;

use App\DetalleMenu;
use App\DetallePlato;
use App\Exports\DetalleMenuExport;
use App\Http\Controllers\Controller;
use App\Menu;
use App\TipoMenu;
use App\TipoPlato;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class MenuController extends Controller
{
    public function ListTipoMenuCrear()
    {
        $dato = TipoMenu::where('estado', 'M')->get();
        return $dato;
    }

    public function listTipoPlatoCrear()
    {
        $dato = TipoPlato::where('estado', 'P')->get();
        return $dato;
    }

    public function create(Request $request)
    {

        /*        $date = Carbon::now();
        $date = Carbon::parse($request->cFecha)->format('Y-m-d');


        if ($request->tipoPlato == 1) {
            $menuEntrada = new MenuEntrada();
            $menuEntrada->nombre = mb_strtoupper($request->cNombre);
            $menuEntrada->fecha = $date;
            $menuEntrada->estado = 'P';
            $menuEntrada->save();
            return response()->json(['message' => 'Menu entrada agregado', 'icon' => 'success'], 200);
        }

        if ($request->tipoPlato == 2) {
            $menuSegundo = new MenuSegundo();
            $menuSegundo->nombre = mb_strtoupper($request->cNombre);
            $menuSegundo->fecha = $date;
            $menuSegundo->estado = 'P';
            $menuSegundo->save();
            return response()->json(['message' => 'Menu Segundo agregado', 'icon' => 'success'], 200);
        }

        if ($request->tipoPlato == 3) {
            $menuExtra = new MenuExtra();
            $menuExtra->nombre = mb_strtoupper($request->cNombre);
            $menuExtra->fecha = $date;
            $menuExtra->estado = 'P';
            $menuExtra->save();
            return response()->json(['message' => 'Menu Extra agregado', 'icon' => 'success'], 200);
        } */
    }

    public function createMenu(Request $request)
    {


        $date = Carbon::now();
        $fecha = $date->format('Y-m-d');
        $hora = $date->format('H:i');

        $menu = new Menu();
        $menu->tipomenu_id = $request->nIdTipo;
        $menu->fecha = $fecha;
        $menu->hora = $hora;
        $menu->user_id = $request->nIdUser;
        $menu->save();

        ///// SOLO  ENTRADA  //////////
        if ($request->nIdTipo == 1) {
           
            $detalleMenu = new DetalleMenu();
            $detalleMenu->menu_id = $menu->id;
            $detalleMenu->cant_entrada = $request->numEntrada;
            $detalleMenu->plato_entrada_id = $request->nIdTipoEntrada;
            $detalleMenu->observacionEntrada = $request->cObsEntrada;
            $detalleMenu->cant_segundo = 0;
            $detalleMenu->plato_segundo_id = 1;
            $detalleMenu->observacionSegundo = NULL;
            $detalleMenu->cant_extra = 0;
            $detalleMenu->plato_extra_id = 1;
            $detalleMenu->observacionExtra = NULL;
            $detalleMenu->save();
        }


            ///// SOLO  SEGUNDA  //////////
            if ($request->nIdTipo == 2) {
                $detalleMenu = new DetalleMenu();
                $detalleMenu->menu_id = $menu->id;
                $detalleMenu->cant_entrada = 0;
                $detalleMenu->plato_entrada_id = 1;
                $detalleMenu->observacionEntrada = NULL;
                $detalleMenu->cant_segundo = $request->numSegundo;
                $detalleMenu->plato_segundo_id = $request->nIdTipoSegundo;
                $detalleMenu->observacionSegundo = $request->cObsSegundo;
                $detalleMenu->cant_extra = 0;
                $detalleMenu->plato_extra_id = 1;
                $detalleMenu->observacionExtra = NULL;
                $detalleMenu->save();
            }

            ////// MENU COMPLETO //////////////
            if ($request->nIdTipo == 3) {
                $detalleMenu = new DetalleMenu();
                $detalleMenu->menu_id = $menu->id;
                $detalleMenu->cant_entrada = $request->numEntrada;
                $detalleMenu->plato_entrada_id = $request->nIdTipoEntrada;
                $detalleMenu->observacionEntrada = $request->cObsEntrada;
                $detalleMenu->cant_segundo = $request->numSegundo;
                $detalleMenu->plato_segundo_id = $request->nIdTipoSegundo;
                $detalleMenu->observacionSegundo = $request->cObsSegundo;
                $detalleMenu->cant_extra = 0;
                $detalleMenu->plato_extra_id = 1;
                $detalleMenu->observacionExtra = NULL;
                $detalleMenu->save();
            }


            /////  SOLO  EXTRA  ////////
            if ($request->nIdTipo == 4) {
                $detalleMenu = new DetalleMenu();
                $detalleMenu->menu_id = $menu->id;
                $detalleMenu->cant_entrada = 0;
                $detalleMenu->plato_entrada_id = 1;
                $detalleMenu->observacionEntrada = NULL;
                $detalleMenu->cant_segundo = 0;
                $detalleMenu->plato_segundo_id = 1;
                $detalleMenu->observacionSegundo = NULL;
                $detalleMenu->cant_extra = $request->numExtra;
                $detalleMenu->plato_extra_id = $request->nIdTipoExtra;
                $detalleMenu->observacionExtra = $request->cObsExtra;
                $detalleMenu->save();
            }

            ///////  EXTRA  CON  ENTRADA ///////

            if ($request->nIdTipo == 5) {
                $detalleMenu = new DetalleMenu();
                $detalleMenu->menu_id = $menu->id;
                $detalleMenu->cant_entrada = $request->numEntrada;
                $detalleMenu->plato_entrada_id = $request->nIdTipoEntrada;
                $detalleMenu->observacionEntrada = $request->cObsEntrada;
                $detalleMenu->cant_segundo = 0;
                $detalleMenu->plato_segundo_id = 1;
                $detalleMenu->observacionSegundo = NULL;
                $detalleMenu->cant_extra = $request->numExtra;
                $detalleMenu->plato_extra_id = $request->nIdTipoExtra;
                $detalleMenu->observacionExtra = $request->cObsExtra;
                $detalleMenu->save();
            }

    }
    public function ListMenuEntrada(Request $request)
    {
        $date = Carbon::now();
        $fecha = $date->format('Y-m-d');
        $dato = DetallePlato::with('plato')->where('fecha', $fecha)->where('tipoplato_id', 1)->get();

        return $dato;
    }

    public function ListMenuSegundo(Request $request)
    {
        $date = Carbon::now();
        $fecha = $date->format('Y-m-d');
        $dato = DetallePlato::with('plato')->where('fecha', $fecha)->where('tipoplato_id', 2)->get();

        return $dato;
    }

    public function ListMenuExtra(Request $request)
    {
        $date = Carbon::now();
        $fecha = $date->format('Y-m-d');
        $dato = DetallePlato::with('plato')->where('fecha', $fecha)->where('tipoplato_id', 3)->get();

        return $dato;
    }

    public function ListMenubyDate()
    {
        $date = Carbon::now();
        $fecha = $date->format('Y-m-d');
        $dato = DetalleMenu::with('menu', 'menu.user','menu.tipomenu', 'plato_entrada', 'plato_segundo', 'plato_extra')->whereHas('menu', function (Builder $query) use ($fecha) {
            $query->where('fecha', $fecha);
        })->get();
        return $dato;



        /*    $dato = DetalleMenu::with('menu', 'menu.user')->whereHas('menu', function (Builder $query) use ($fecha) {
            $query->where('fecha', $fecha)->where('estado', 'E');
        })->get();
        return $dato; */
    }

    public function ListMenuDetallebyDate(Request $request)
    {
        $fechainicio = substr($request->dFechainicio, 0, -14);
        $fechafin = substr($request->dFechafin, 0, -14);
        $dato = DetalleMenu::with('menu', 'menu.user','menu.tipomenu', 'plato_entrada', 'plato_segundo', 'plato_extra')->whereHas('menu', function (Builder $query) use ($fechainicio, $fechafin) {
            $query->whereBetween('fecha', [$fechainicio, $fechafin]);
        })->get();
        return $dato;
    }

    public function setAnular(Request $request)
    {
        $menu = Menu::find($request->item);
        $menu->delete();

    }

    public function export(Request $request)
    {

        $listeMenuDetallexFecha = json_decode($request->params['listeMenuDetallexFecha']);
        return (new DetalleMenuExport)->setGenerarExcel($listeMenuDetallexFecha)->download('invoices.xlsx');
    }
}
