<?php

namespace App\Http\Controllers\Administracion;

use App\DetalleMenu;
use App\Exports\DetalleMenuExport;
use App\Http\Controllers\Controller;
use App\Menu;
use App\MenuEntrada;
use App\MenuExtra;
use App\MenuSegundo;
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
        $date = Carbon::now();
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
        }
    }

    public function createMenu(Request $request)
    {

        $date = Carbon::now();
        $fecha = $date->format('Y-m-d');
        $hora = $date->toTimeString();

        $menu = new Menu();
        $menu->user_id = $request->nIdUser;
        $menu->fecha = $fecha;
        $menu->hora = $hora;
        $menu->observacion = mb_strtoupper($request->cObservacion);
        $menu->estado = 'E';
        $menu->save();

        $detallemenu = new DetalleMenu();
        $detallemenu->menu_id =  $menu->id;


        if ($request->nIdTipoEntrada == null) {
            $detallemenu->menuentrada_id = 1;
            $detallemenu->cantEntrada = 0;
        } else {
            $detallemenu->menuentrada_id = $request->nIdTipoEntrada;
            $detallemenu->cantEntrada = $request->numEntrada;
        }


        if ($request->nIdTipoSegundo == null) {
            $detallemenu->menusegundo_id = 1;
            $detallemenu->cantSegundo = 0;
        } else {
            $detallemenu->menusegundo_id = $request->nIdTipoSegundo;
            $detallemenu->cantSegundo = $request->numSegundo;
        }


        if ($request->nIdTipoExtra == null) {
            $detallemenu->menuextra_id = 1;
            $detallemenu->cantExtra = 0;
        } else {
            $detallemenu->menuextra_id = $request->nIdTipoExtra;
            $detallemenu->cantExtra = $request->numExtra;
        }
        $detallemenu->tipomenu_id = $request->nIdTipo;
        $detallemenu->save();
    }
    public function ListMenuEntrada(Request $request)
    {
        $fecha = substr($request->dFecha, 0, -14);
        $dato = MenuEntrada::where('fecha', $fecha)->where('estado', 'P')->get();
        return $dato;
    }

    public function ListMenuSegundo(Request $request)
    {
        $fecha = substr($request->dFecha, 0, -14);
        $dato = MenuSegundo::where('fecha', $fecha)->where('estado', 'P')->get();
        return $dato;
    }

    public function ListMenuExtra(Request $request)
    {
        $fecha = substr($request->dFecha, 0, -14);
        $dato = MenuExtra::where('fecha', $fecha)->where('estado', 'P')->get();
        return $dato;
    }

    public function ListMenubyDate()
    {
        $date = Carbon::now();
        $fecha = $date->format('Y-m-d');
        $dato = DetalleMenu::with('menu', 'menu.user', 'menuentrada', 'menusegundo', 'menuextra', 'tipomenu')->whereHas('menu', function (Builder $query) use ($fecha) {
            $query->where('fecha', $fecha)->where('estado', 'E');
        })->get();
        return $dato;
    }

    public function ListMenuDetallebyDate(Request $request)
    {
        $fechainicio = substr($request->dFechainicio, 0, -14);
        $fechafin = substr($request->dFechafin, 0, -14);
        $dato = DetalleMenu::with('menu', 'menu.user', 'menuentrada', 'menusegundo', 'menuextra', 'tipomenu')->whereHas('menu', function (Builder $query) use ($fechainicio, $fechafin) {
            $query->whereBetween('fecha', [$fechainicio, $fechafin])->where('estado', 'E');
        })->get();
        return $dato;
    }

    public function setAnular(Request $request)
    {
        $menu = Menu::find($request->item);
        $menu->estado = 'A';
        $menu->save();
    }

    public function export(Request $request)
    {

        $listeMenuDetallexFecha = json_decode($request->params['listeMenuDetallexFecha']);
        return (new DetalleMenuExport)->setGenerarExcel($listeMenuDetallexFecha)->download('invoices.xlsx');
    }
}
