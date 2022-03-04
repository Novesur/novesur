<?php

namespace App\Http\Controllers\Administracion;

use App\Detalleordenservicio;
use App\Http\Controllers\Controller;
use App\Ordenservicio;
use App\Producto;
use App\TempOrdenServicio;
use App\UnidMedida;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;
use PDF;

class OrdenServicioController extends Controller
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
            $tempOrder = new TempOrdenServicio();
            $tempOrder->fill(['cantidad' => $request->cCantidad, 'unidmedida_id' => $request->nIdUnidMed, 'codigo' => $product->codigo, 'producto_id' => $request->nIdprod, 'punit' => $request->cPrecio, 'total' => $request->cTotal, 'productoFamilia' => $articulo->familia->nombre, 'productoSubfamilia' => $articulo->subfamilia->nombre, 'productoModelotipo' => $articulo->modelotipo->nombre, 'productoMarca' => $articulo->marca->nombre, 'unidmedNombre' => $unidmed->nombre, 'material' => $product->material->nombre, 'homologacion' => $product->homologacion->nombre]);
            $products->push($tempOrder);
            Session::put('products', $products);
            //return response()->json("Grabado");
            return response()->json(['datos' => $products, 'message' => NULL]);

        endif;
    }

    public function create(Request $request)
    {


        $femision = date("Y-m-d", strtotime($request->cFechaEmision));
        $fentrega = date("Y-m-d", strtotime($request->cFechaEntrega));


        $countOrdenServicio = Ordenservicio::count();
        if($countOrdenServicio == 0){
            $codpIngreso = 'S0001'.'-'. Carbon::parse($request->cFechaEmision)->format('Y');
        }else{
            $codpIngreso = 'S'.sprintf('%04d',$countOrdenServicio +1) .'-'. Carbon::parse($request->cFechaEmision)->format('Y');
        }

        if ($request->session()->has('products')) {
            $ordenServicio = new Ordenservicio();
            $ordenServicio->codigo =  $codpIngreso;
            $ordenServicio->Femision =  $femision;
            $ordenServicio->Referencia =  mb_strtoupper($request->cReferencia);
            $ordenServicio->proveedor_id =  $request->nIdProveedor;
            $ordenServicio->Fentrega =  $fentrega;
            $ordenServicio->LugarEntrega =  mb_strtoupper($request->cLEntrega);
            $ordenServicio->pago_id =  $request->nIdTipoPago;
            $ordenServicio->user_id =  $request->nIdUser;
            $ordenServicio->estadoordencompra_id = 2;
            $ordenServicio->observacion = $request->cObservacion;
            $ordenServicio->tipocambio_id = $request->nIdTipoMoneda;
            $ordenServicio->save();
            $detordenServicio = Session::get('products');
            $allProducts = $detordenServicio->map(function ($product) use ($ordenServicio) {
                return [
                    'ordenservicio_id'   => $ordenServicio->id,
                    'producto_id'       => $product->producto_id,
                    'cantidad'          => $product->cantidad,
                    'cantidadKardex'    => $product->cantidad,
                    'unidmedida_id'     => $product->unidmedida_id,
                    'punit'             => $product->punit,
                    'estado'            => 1,
                ];
            });
            DetalleordenServicio::insert($allProducts->toArray());
            Session::put('products', collect([]));
            return response()->json(['message' => 'Grabado', 'icon' => 'success'], 200);
        } else {
            return response()->json(['message' => 'El item no existe', 'icon' => 'warning'], 200);
        }
    }

    public function ListXProveedor(Request $request)
    {
        if ($request->nidProveedor == null) {
            $dato = Ordenservicio::with('proveedor', 'user', 'estadoordencompra', 'pago')->get();
            return $dato;
        }else{
            $dato = Ordenservicio::with('proveedor', 'user', 'estadoordencompra', 'pago')
            ->where('proveedor_id', $request->nidProveedor)
            ->where('estadoordencompra_id', 2)->get();
            return $dato;
        }
    }

    public function setGenerarOrderPedidoPdf(Request $request)
    {

        $valor = $request->get("params")['idOrderPedido'];
        $orderServicio = Ordenservicio::with('proveedor',  'user', 'estadoordencompra', 'pago')->where('id', $valor)->first();
        $DetalleOrderServicio = Detalleordenservicio::with('ordenservicio', 'unidmedida', 'producto')->where('ordenservicio_id', $valor)->get();

        $logo = asset('img/logo.gif');
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('reporte.cotizacion.ordenserviciopdf', [
            'logo' => $logo,
            'orderServicio' => $orderServicio,
            'DetalleOrderServicio' => $DetalleOrderServicio,
        ]);
        return $pdf->download('invoice.pdf');;
    }

    public function setDarBajaOrderServicio(Request $request){

        $ordencompra = Ordenservicio::where('codigo', $request->codigo)->first();
        $ordencompra->estadoordencompra_id = '1';
        $ordencompra->save();
    }

    public function CargaDatosOrdenServicio(Request $request){

        $codOrderServicio = Ordenservicio::where('codigo', $request->nidOrdenServicio)->first();
        $dato = Detalleordenservicio::with('ordenservicio', 'ordenservicio.proveedor')->where('id', $codOrderServicio->id)->first();
        return $dato;

    }

    public function ListXProduct(Request $request)
    {
               $nIdprod = $request->nIdprod;

               $dato =  Detalleordenservicio::with('ordenservicio','unidmedida','producto','ordenservicio.proveedor')
                   ->whereHas('ordenservicio', function (Builder $query) use ($nIdprod) {$query->where('producto_id', $nIdprod);
                   })->get();

                   return $dato;
    }

}
