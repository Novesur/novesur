<?php

namespace App\Http\Controllers\Administracion;

use App\Detalleordencompra;
use App\Http\Controllers\Controller;
use App\Ordencompra;
use App\Producto;
use App\TempOrdenCompra;
use App\Tipocambio;
use App\UnidMedida;
use Illuminate\Http\Request;
use PDF;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

class OrdencompraController extends Controller
{
    public function addOrden(Request $request)
    {
        $product = Producto::where(['id' => $request->nIdprod])->with('familia', 'marca', 'material', 'modelotipo', 'subfamilia', 'homologacion')->first();
        $products = Session::get('products');
        $products = ($products != null) ? collect($products) : collect([]);
        $exists = $products->firstWhere("producto_id", $product->id);
        if (!empty($exists)) :
            // return response()->json(['message' => "Ya fue agregado anteriormente"], 422);
            return response()->json(['datos' => $products, 'message' => 'Ya fue agregado anteriormente', 'icon' => 'error'], 200);

        else :
            $articulo = $product;
            $unidmed = UnidMedida::where(['id' => $request->nIdUnidMed])->first();
            $tempOrder = new TempOrdenCompra;
            $tempOrder->fill(['cantidad' => $request->cCantidad, 'unidmedida_id' => $request->nIdUnidMed, 'codigo' => $product->codigo, 'producto_id' => $request->nIdprod, 'punit' => $request->cPrecio, 'total' => $request->cTotal, 'productoFamilia' => $articulo->familia->nombre, 'productoSubfamilia' => $articulo->subfamilia->nombre, 'productoModelotipo' => $articulo->modelotipo->nombre, 'productoMarca' => $articulo->marca->nombre, 'unidmedNombre' => $unidmed->nombre, 'material' => $product->material->nombre, 'homologacion' => $product->homologacion->nombre]);
            $products->push($tempOrder);
            Session::put('products', $products);
            //return response()->json("Grabado");
            return response()->json(['datos' => $products, 'message' => NULL]);

        endif;
    }

    public  function ListtempOrden()
    {
        $dato = session()->get('products') ?? collect([]);
        return response()->json(['datos' => $dato]);
    }

    public function eliminarTemporder()
    {
        Session::put('products', null);
        $dato = session()->get('products') ?? collect([]);
        return response()->json(['datos' => $dato]);
    }

    public function create(Request $request)
    {


        $femision = date("Y-m-d", strtotime($request->cFechaEmision));
        $fentrega = date("Y-m-d", strtotime($request->cFechaEntrega));


        $countPIngreso = Ordencompra::count();
        if($countPIngreso == 0){
            $codpIngreso = 'C0001'.'-'. Carbon::parse($request->cFechaEmision)->format('Y');
        }else{
            $codpIngreso = 'C'.sprintf('%04d',$countPIngreso +1) .'-'. Carbon::parse($request->cFechaEmision)->format('Y');
        }

        if ($request->session()->has('products')) {
            $ordenCompra = new Ordencompra();
            $ordenCompra->codigo =  $codpIngreso;
            $ordenCompra->Femision =  $femision;
            $ordenCompra->Referencia =  mb_strtoupper($request->cReferencia);
            $ordenCompra->proveedor_id =  $request->nIdProveedor;
            $ordenCompra->Fentrega =  $fentrega;
            $ordenCompra->LugarEntrega =  mb_strtoupper($request->cLEntrega);
            $ordenCompra->pago_id =  $request->nIdTipoPago;
            $ordenCompra->user_id =  $request->nIdUser;
            $ordenCompra->estadoordencompra_id = 2;
            $ordenCompra->observacion = $request->cObservacion;
            $ordenCompra->tipocambio_id = $request->nIdTipoMoneda;
            $ordenCompra->save();
            $detordenCompra = Session::get('products');
            $allProducts = $detordenCompra->map(function ($product) use ($ordenCompra) {
                return [
                    'ordencompras_id'   => $ordenCompra->id,
                    'producto_id'       => $product->producto_id,
                    'cantidad'          => $product->cantidad,
                    'cantidadKardex'    => $product->cantidad,
                    'unidmedida_id'     => $product->unidmedida_id,
                    'punit'             => $product->punit,
                    'estado'            => 1,
                ];
            });
            Detalleordencompra::insert($allProducts->toArray());
            Session::put('products', collect([]));
            return response()->json(['message' => 'Grabado', 'icon' => 'success'], 200);
        } else {
            return response()->json(['message' => 'El item no existe', 'icon' => 'warning'], 200);
        }
    }

    public function TipoCambio()
    {
        $data = Tipocambio::all();
        return $data;
    }

    public function ListXProduct(Request $request)
    {
               $nIdprod = $request->nIdprod;

               $dato =  Detalleordencompra::with('ordencompras','unidmedida','producto','ordencompras.proveedor')
                   ->whereHas('ordencompras', function (Builder $query) use ($nIdprod) {$query->where('producto_id', $nIdprod);
                   })->get();

                   return $dato;
    }

    public function ListXProveedor(Request $request)
    {
        if ($request->nidProveedor == null) {
            $dato = Ordencompra::with('proveedor', 'user', 'estadoordencompra', 'pago')->get();
            return $dato;
        }else{
            $dato = Ordencompra::with('proveedor', 'user', 'estadoordencompra', 'pago')
            ->where('proveedor_id', $request->nidProveedor)
            ->where('estadoordencompra_id', 2)->get();
            return $dato;
        }
    }

    public function setGenerarOrderPedidoPdf(Request $request)
    {

        $valor = $request->get("params")['idOrderPedido'];
        $orderCompra = Ordencompra::with('proveedor',  'user', 'estadoordencompra', 'pago')->where('id', $valor)->first();
        $DetalleOrderCompra = Detalleordencompra::with('ordencompras', 'unidmedida', 'producto')->where('ordencompras_id', $valor)->get();

        $logo = asset('img/logo02.png');
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('reporte.cotizacion.ordencomprapdf', [
            'logo' => $logo,
            'orderCompra' => $orderCompra,
            'DetalleOrderCompra' => $DetalleOrderCompra,
        ]);
        return $pdf->download('invoice.pdf');;
    }

    public function ListarDatosOrdenCompraXId(Request $request){

        $dato = Ordencompra::with('proveedor', 'user', 'estadoordencompra', 'pago')->where('id', $request->nIdOrdenCompra)->first();
     return $dato;

    }

    public function setDarBajaOrderCompra(Request $request){

        $ordencompra = Ordencompra::where('codigo', $request->codigo)->first();
        $ordencompra->estadoordencompra_id = '1';
        $ordencompra->save();
    }

    public function CargaDatosOrdenCompra(Request $request){

        $ordencompra = Ordencompra::where('codigo', $request->nidOrdenCompra)->first();
        $dato = Detalleordencompra::with('ordencompras', 'ordencompras.proveedor')->where('ordencompras_id', $ordencompra->id)->first();
        return $dato;

    }
}
