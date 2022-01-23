<?php

namespace App\Http\Controllers\Administracion;

use App\DetalleKardex;
use App\Detalleordencompra;
use App\Detalleparteingreso;
use App\Http\Controllers\Controller;
use App\Kardex;
use App\Ordencompra;
use App\Parteingreso;
use App\Partesalida;
use Illuminate\Http\Request;
use App\Producto;
use App\UnidMedida;
use Illuminate\Support\Facades\Session;
use App\TempPIngreso;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PDF;

class ParteIngresoController extends Controller
{
    public function addPIngreso(Request $request)
    {
        $product = Producto::where(['id' => $request->nIdprod])->with('familia', 'marca', 'material', 'modelotipo', 'subfamilia', 'homologacion')->first();
        $pingreso = Session::get('pingreso');
        $pingreso = ($pingreso != null) ? collect($pingreso) : collect([]);
        $exists = $pingreso->firstWhere("producto_id", $product->id);
        if (!empty($exists)) :
            // return response()->json(['message' => "Ya fue agregado anteriormente"], 422);
            return response()->json(['datos' => $pingreso, 'message' => 'Ya fue agregado anteriormente', 'icon' => 'error'], 200);
        else :
            $articulo = $product;
            $unidmed = UnidMedida::where(['id' => $request->nIdUnidMed])->first();
            $tempPIngreso = new TempPIngreso;
            $tempPIngreso->fill(['cantidad' => $request->cCantidad, 'unidmedida_id' => $request->nIdUnidMed, 'codigo' => $product->codigo, 'producto_id' => $request->nIdprod, 'punit' => $request->cPrecio,  'productoFamilia' => $articulo->familia->nombre, 'productoSubfamilia' => $articulo->subfamilia->nombre, 'productoModelotipo' => $articulo->modelotipo->nombre, 'productoMarca' => $articulo->marca->nombre, 'unidmedNombre' => $unidmed->nombre, 'material' => $product->material->nombre, 'homologacion' => $product->homologacion->nombre, 'cantidad' => $request->cCantidad]);
            $pingreso->push($tempPIngreso);
            Session::put('pingreso', $pingreso);
            return response()->json(['icon' => 'success'], 200);


        endif;
    }

    public  function ListtempParteIngreso()
    {
        $dato = session()->get('pingreso') ?? collect([]);
        return response()->json(['datos' => $dato]);
    }

    public function eliminarTempitemPIngreso()
    {
        Session::put('pingreso', null);
        $dato = session()->get('pingreso') ?? collect([]);
        return response()->json(['datos' => $dato]);
    }

    public function setGrabaPIngreso(Request $request)
    {

        ///  Graba Parte de Ingreso  //////////////
        $parteIngreso = new Parteingreso();
        $date = Carbon::now();
        $countPIngreso = Parteingreso::count();
        $date = Carbon::parse($request->cFecha)->format('Y-m-d');

        if($countPIngreso == 0){
            $codPi = '0001'.'-'. Carbon::parse($request->cFecha)->format('Y');
        }else{
            $codPi = sprintf('%04d',$parteIngreso->id + 1).'-'. Carbon::parse($request->cFecha)->format('Y');
        }
        $parteIngreso->codigo =  $codPi;
        $parteIngreso->proveedor_id =  $request->nIdProveedor;
        $parteIngreso->Nrofactura = mb_strtoupper($request->nroFactura);
        $parteIngreso->Nroguia = mb_strtoupper($request->nroguia);
        $parteIngreso->motivo_id = $request->nIdMotivo;
        $parteIngreso->Fecha = $date;
        $parteIngreso->observacion = mb_strtoupper($request->cobservacion);
        $parteIngreso->user_id = $request->nIdUser;
        $parteIngreso->estadoparte_id = '1';
        $parteIngreso->save();
        ///  Graba Parte de DetalleParteIngreso  //////////////
        $detalleParteIngreso = new Detalleparteingreso();
        $detalleParteIngreso->parteingreso_id = $parteIngreso->id;
        $detalleParteIngreso->ordencompras_id = $request->nIdOrdenCompra;
        $detalleParteIngreso->save();

        $dato = Detalleordencompra::with('producto')
            ->where('ordencompras_id', $request->nIdOrdenCompra)
            ->where('estado', '1')->get();

        foreach ($dato as $data) {
            $countProductkardex = Kardex::where('producto_id', $data->producto_id)->count();
            if ($countProductkardex == 0) {
                $kardex = new Kardex();
                $kardex->producto_id = $data->producto_id;
                $kardex->stock = $data->cantidadKardex;
                $kardex->costunit = $data->punit;
                $kardex->diferencia = null;
                $kardex->save();

            }else{
                $kardex = Kardex::where('producto_id', $data->producto_id)->first();
                $kardex->producto_id = $kardex->producto_id ;
                $kardex->stock = $kardex->stock + $data->cantidadKardex ;
                $kardex->costunit = $data->punit ;
                $kardex->diferencia = $kardex->diferencia ;
                $kardex->save();
            }

            $detallekardex = new DetalleKardex();
            $detallekardex->kardex_id = $kardex->id;
            $detallekardex->fecha = $date;
            $detallekardex->FactNo = mb_strtoupper($request->nroFactura);
            $detallekardex->GuiaNo = mb_strtoupper($request->nroguia);
            $detallekardex->proveedor_id = $request->nIdProveedor;
            $detallekardex->motivo_id = $request->nIdMotivo;
            $detallekardex->unidmedida_id = $data->unidmedida_id;
            $detallekardex->cantidad = $data->cantidadKardex;
            $detallekardex->costunit = $data->punit;
            $detallekardex->movimiento_id = '1';
            $detallekardex->user_id = $request->nIdUser;
            $detallekardex->cliente_id = '202';
            $detallekardex->save();
        }

        Ordencompra::where('id', $request->nIdOrdenCompra)->update(['estadoordencompra_id' => '1']);

        return response()->json(['message' => 'Grabado con exitos', 'icon' => 'success'], 200);


    }

    public function ListParteIngreso(Request $request){

            $nIdProveedor = $request->nIdProveedor;
            $fecha1 = Carbon::parse($request->fecha1)->format('Y-m-d');
            $fecha2 = Carbon::parse($request->fecha2)->format('Y-m-d');
            $dFecha = $request->dFecha;
            if($nIdProveedor){
                $dato = Detalleparteingreso::with('parteingreso','ordencompras','Parteingreso.proveedor','Parteingreso.motivo','Parteingreso.user')
                ->whereHas('Parteingreso',function(Builder $query)use($nIdProveedor){$query->where('proveedor_id',$nIdProveedor);
                })->get();
                return $dato;
            }

            if($dFecha){
                $dato = Detalleparteingreso::with('parteingreso','ordencompras','Parteingreso.proveedor','Parteingreso.motivo','Parteingreso.user')
                ->whereHas('Parteingreso',function(Builder $query)use($fecha1 , $fecha2){$query->whereBetween('Fecha', [$fecha1, $fecha2]);
                })->get();
                    return $dato;
    }

    }

    public function ListParteIngresoxNroOrden(Request $request){
        //$dato = Parteingreso::with('proveedor','motivo')->where('codigo',$request->Norden)->get();
        $dato = DetalleParteIngreso::with('parteingreso','ordencompras','Parteingreso.proveedor','Parteingreso.motivo')->where('ordencompras_id', $request->Norden)->get();
        return $dato;
    }

    public function ProveedorFechaPdf(Request $request){
           //dd($request->get("params")['item']);
           $valor = $request->get("params")['item'];
           $PartI = Parteingreso::with('proveedor')->where('id', $valor)->first();
           $CodOrdCompra = Detalleparteingreso::with('ordencompras')->where('parteingreso_id', $valor)->first();
           $detPartI = Detalleparteingreso::with('parteingreso', 'ordencompras')->where('parteingreso_id', $valor)->first();
         $detalleOrdenCompra =  Detalleordencompra::with('producto', 'unidmedida','producto.familia','producto.subfamilia','producto.modelotipo','producto.marca','producto.material','producto.homologacion')->where('ordencompras_id', $detPartI->ordencompras_id)->get();
           $logo = asset('img/logo02.png');
           $productos01 = asset('img/banner01.png');
           $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('reporte.parteIngreso.ReporteProductFecha', [
               'logo' => $logo,
               'productos01' => $productos01,
               'PartI' => $PartI,
               'CodOrdCompra' => $CodOrdCompra,
               'detalleOrdenCompra' => $detalleOrdenCompra,
           ]);

           return $pdf->download('invoice.pdf');

    }

    public function ProveedorOrdenCompraPdf(Request $request){
        //dd($request->get("params")['item']);

        $valor = $request->get("params")['item'];
       $idOrdenCompra = Detalleparteingreso::where('ordencompras_id',  $valor )->first();
        $PartI = Parteingreso::with('proveedor')->where('id', $idOrdenCompra->parteingreso_id)->first();
       // dd($valor); // = 1
        $CodOrdCompra = Detalleparteingreso::with('ordencompras')->where('ordencompras_id', $valor)->first();
        //dd( $CodOrdCompra );
        $detPartI = Detalleparteingreso::with('parteingreso', 'ordencompras')->where('ordencompras_id', $valor)->first();
        $detalleOrdenCompra =  Detalleordencompra::with('producto', 'unidmedida','producto.familia','producto.subfamilia','producto.modelotipo','producto.marca','producto.material','producto.homologacion')->where('ordencompras_id', $detPartI->ordencompras_id)->get();

      $logo = asset('img/logo02.png');
        $productos01 = asset('img/banner01.png');
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('reporte.parteIngreso.ReporteNroOrden', [
            'logo' => $logo,
            'productos01' => $productos01,
            'PartI' => $PartI,
            'CodOrdCompra' => $CodOrdCompra,
            'detalleOrdenCompra' => $detalleOrdenCompra,
        ]);

        return $pdf->download('invoice.pdf');

 }

}
