<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use App\Producto;
use App\TempMaterialOrdenProd;
use App\TempRequerimientos;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

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



    }
}
