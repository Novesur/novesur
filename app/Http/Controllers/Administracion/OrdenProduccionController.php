<?php

namespace App\Http\Controllers\Administracion;

use App\Cliente;
use App\Http\Controllers\Controller;
use App\MaterialOrdenProduccion;
use App\OrdenProduccion;
use App\OtrosRequerimientosOrdenProduc;
use App\Producto;
use App\RequerimientoManoObra;
use App\TempMaterialOrdenProd;
use App\TempRequerimientos;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class OrdenProduccionController extends Controller
{
    public function addOrden(Request $request)
    {
        $product = Producto::where(['id' => $request->nIdmaterial])->with('familia', 'marca', 'material', 'modelotipo', 'subfamilia', 'homologacion')->first();
        $products = Session::get('materialOrdenprod');
        $products = ($products != null) ? collect($products) : collect([]);
        $exists = $products->firstWhere("producto_id", $product->id);
        if (!empty($exists)) :
            // return response()->json(['message' => "Ya fue agregado anteriormente"], 422);
            return response()->json(['datos' => $products, 'message' => 'Ya fue agregado anteriormente', 'icon' => 'error'], 200);
        else :
            $articulo = $product;
            $tempOrder = new TempMaterialOrdenProd();
            $tempOrder->fill(['cantidad' => $request->cCantMaterial,  'codigo' => $product->codigo, 'producto_id' => $request->nIdmaterial,  'productoFamilia' => $articulo->familia->nombre, 'productoSubfamilia' => $articulo->subfamilia->nombre, 'productoModelotipo' => $articulo->modelotipo->nombre, 'productoMarca' => $articulo->marca->nombre,  'material' => $product->material->nombre, 'homologacion' => $product->homologacion->nombre]);
            $products->push($tempOrder);
            Session::put('materialOrdenprod', $products);
            //return response()->json("Grabado");
            return response()->json(['datos' => $products, 'message' => NULL]);
        endif;
    }

    public  function eliminarTemporder()
    {
        Session::put('materialOrdenprod', null);
        $dato = session()->get('materialOrdenprod') ?? collect([]);
        return response()->json(['datos' => $dato]);
    }

    public function addMObra(Request $request)
    {
        $materiales = Session::get('MaterialManoObra');
        $materiales = ($materiales != null) ? collect($materiales) : collect([]);
        $tempMatOrdenMaterial = new TempMaterialOrdenProd();
        $tempMatOrdenMaterial->fill(['personal' => $request->cPersonal, 'dias' => $request->cDiasMObra, 'horas' => $request->cHorasMObra]);
        $materiales->push($tempMatOrdenMaterial);
        Session::put('MaterialManoObra', $materiales);
        return response()->json(['datos' => $materiales, 'message' => NULL]);
    }

    public function CleanMaterialManoOBra()
    {
        Session::put('MaterialManoObra', null);
        $dato = session()->get('MaterialManoObra') ?? collect([]);
        return response()->json(['datos' => $dato]);
    }

    public function addRequerimientos(Request $request)
    {
        $requerimientos = Session::get('Requerimientos');
        $requerimientos = ($requerimientos != null) ? collect($requerimientos) : collect([]);
        $tempRequerimientos = new TempRequerimientos();
        $tempRequerimientos->fill(['descripcion' => $request->cDescripcion, 'dias' => $request->cDiasReq, 'horas' => $request->cHorasRequ]);
        $requerimientos->push($tempRequerimientos);
        Session::put('Requerimientos', $requerimientos);
        return response()->json(['datos' => $requerimientos, 'message' => NULL]);
    }

    public function CleanRequerimientos()
    {
        Session::put('Requerimientos', null);
        $dato = session()->get('Requerimientos') ?? collect([]);
        return response()->json(['datos' => $dato]);
    }

    public function create(Request $request){

        $codclient = Cliente::where('ruc', $request->cRuc)->first();

        if($codclient){
            $idclient = $codclient->id;
            $stock = 0;
        }else{
            $idclient = '202';
            $stock = $request->cCantstock;
        }
        $dateIni = Carbon::parse($request->FInicio)->format('Y-m-d');
        $dateFinal = Carbon::parse($request->FFinal)->format('Y-m-d');

        $ordenProduccion = new OrdenProduccion();
        $ordenProduccion->producto_id = $request->nIdproduct;
        $ordenProduccion->cantidad = $request->cCantprod;
        $ordenProduccion->cliente_id = $idclient;
        $ordenProduccion->fechainicio = $dateIni;
        $ordenProduccion->fechafinal = $dateFinal;
        $ordenProduccion->user_id = $request->nIdUser;
        $ordenProduccion->save();



        $MaterialOrdenProd = Session::get('materialOrdenprod');
        $allMaterialOP = $MaterialOrdenProd->map(function($MaterialOP) use ($ordenProduccion){
            return[
                'ordenproduccion_id' => $ordenProduccion->id,
                'producto_id' => $MaterialOP->producto_id,
                'cantidad' => $MaterialOP->cantidad
            ];
        });
        MaterialOrdenProduccion::insert($allMaterialOP->toArray());
        DB::commit();
        Session::put('materialOrdenprod', collect([]));



        $RequerimientoManoObra = Session::get('MaterialManoObra');
        $allRequerimientoObra = $RequerimientoManoObra->map(function($ReqManoObra)use ($ordenProduccion){
            return[
                'ordenproduccion_id' => $ordenProduccion->id,
                'personal' => $ReqManoObra->personal,
                'dias' =>  $ReqManoObra->dias,
                'horas' => $ReqManoObra->horas,
            ];
        });
        RequerimientoManoObra::insert($allRequerimientoObra->toArray());
        DB::commit();
        Session::put('MaterialManoObra', collect([]));



        $OtrosRequerimientos = Session::get('Requerimientos');
        $allOtrosReque =  $OtrosRequerimientos->map(function($otrosReque) use ($ordenProduccion){
            return[
                'ordenproduccion_id' => $ordenProduccion->id,
                'descripcion' => $ordenProduccion->descripcion,
                'dias' => $ordenProduccion->dias,
                'horas' => $ordenProduccion->horas,

            ];
        });
        OtrosRequerimientosOrdenProduc::insert($allOtrosReque->toArray());
        DB::commit();
        Session::put('Requerimientos', collect([]));

    }
}
