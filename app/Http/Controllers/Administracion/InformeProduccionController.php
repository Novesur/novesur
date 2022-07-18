<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use App\InfoProduccionManoObra;
use App\InfoProduccionMaterial;
use App\InfoProduccionOtrosRequerimientos;
use App\InformeProduccion;
use App\ManoObraReqmateriales;
use App\MaterialReqMateriales;
use App\OtrosRequerimientosReqMateriales;

use App\RequerimientosMateriales;
use Illuminate\Http\Request;
use Svg\Tag\Rect;
use PDF;

class InformeProduccionController extends Controller
{
    public function CargaInfoProduccion(Request $request)
    {

        $yearMaxID = date("Y");



           $datos = InformeProduccion::count();


            if($datos == 0){
                $codreqMateriales = 'PROD0001' .'-'. $yearMaxID ;
            }else{
                $maxidinfoProd = InformeProduccion::whereRaw('id = (select max(`id`) from informeproduccion)')->first();
                $codreqMateriales = 'PROD'. sprintf('%04d',$maxidinfoProd->id +1).'-'. $yearMaxID;
            }


            $dataReqMateriales = RequerimientosMateriales::with('cliente')->where('codigo', $request->codRequMateriales)->first();


            $dataInfoProd = InformeProduccion::with('cliente')->where('pk_ReqMateriales', $dataReqMateriales->id)->first();



            if(empty($dataInfoProd)){

                $dataReqMateriales = RequerimientosMateriales::with('cliente')->where('codigo', $request->codRequMateriales)->first();
               $InfoProduccion = new InformeProduccion();
               $InfoProduccion->codigo = $codreqMateriales;
               $InfoProduccion->producto_id = $dataReqMateriales->producto_id;
               $InfoProduccion->cantidad = $dataReqMateriales->cantidad;
               $InfoProduccion->unidmedida_id = $dataReqMateriales->unidmedida_id;
               $InfoProduccion->almacen_id = $dataReqMateriales->almacen_id;
               $InfoProduccion->cliente_id = $dataReqMateriales->cliente_id;
               $InfoProduccion->fecha = $dataReqMateriales->fecha;
               $InfoProduccion->fechainicio = $dataReqMateriales->fechainicio;
               $InfoProduccion->fechafinal = $dataReqMateriales->fechafinal;
               $InfoProduccion->duracion = $dataReqMateriales->duracion;
               $InfoProduccion->user_id = $dataReqMateriales->user_id;
               $InfoProduccion-> pk_ReqMateriales = $dataReqMateriales->id;
               $InfoProduccion->save();


               $RequerimientoManoObra = ManoObraReqmateriales::where('pk_ReqMateriales',$InfoProduccion->id)->get();
                 foreach ($RequerimientoManoObra as $dataReq) {
                $InfoProduccionManoObra = new InfoProduccionManoObra();
                $InfoProduccionManoObra->informeproduccion_id = $InfoProduccion->id;
                $InfoProduccionManoObra->personal = strtoupper($dataReq->personal);
                $InfoProduccionManoObra->dias = $dataReq->dias;
                $InfoProduccionManoObra->horas = $dataReq->horas;
                $InfoProduccionManoObra->save();
            }


            $MaterialReqProduccion = MaterialReqMateriales::where('pk_ReqMateriales', $InfoProduccion->id)->get();

            foreach ($MaterialReqProduccion as $dataMatreq) {
                $InfoProduccionMaterial= new InfoProduccionMaterial;
                $InfoProduccionMaterial->informeproduccion_id = $InfoProduccion->id;
                $InfoProduccionMaterial->producto_id = $dataMatreq->producto_id;
                $InfoProduccionMaterial->cantidad = $dataMatreq->cantidad;
                $InfoProduccionMaterial->unidmedida_id = $dataMatreq->unidmedida_id;
                $InfoProduccionMaterial->fecha = $dataMatreq->fecha;
                $InfoProduccionMaterial->costunit = 0.00;
                $InfoProduccionMaterial->total = 0.00;
                $InfoProduccionMaterial->save();
            }



            $OtrosRequMateriales = OtrosRequerimientosReqMateriales::where('pk_ReqMateriales', $InfoProduccion->id)->get();
            foreach ($OtrosRequMateriales as $dataOtrosReqMatProduc) {
                $InfoProduccionOtrosRequerimientos = new InfoProduccionOtrosRequerimientos();
                $InfoProduccionOtrosRequerimientos->informeproduccion_id = $InfoProduccion->id;
                $InfoProduccionOtrosRequerimientos->descripcion = strtoupper($dataOtrosReqMatProduc->descripcion);
                $InfoProduccionOtrosRequerimientos->cantidad = strtoupper($dataOtrosReqMatProduc->cantidad);
                $InfoProduccionOtrosRequerimientos->save();
            }



               $datos = InformeProduccion::with('producto','unidmedida','cliente','almacen')->where('pk_ReqMateriales',$dataReqMateriales->id)->first();

               return $datos;


        }else{

            $datos = InformeProduccion::with('producto','unidmedida','cliente','almacen')->where('pk_ReqMateriales',$dataReqMateriales->id)->first();


            return $datos;

        }


            }

          public function getListReqMatInfoProduc(Request $request){
            $idReqMateriales = RequerimientosMateriales::where('codigo', $request->codReqMat)->first();
            $idOrdProd = InformeProduccion::where('pk_ReqMateriales',$idReqMateriales->id)->first();

            $dato = InfoProduccionMaterial::with('producto', 'producto.marca', 'producto.familia', 'producto.material', 'producto.modelotipo', 'producto.subfamilia','unidmedida')->where('informeproduccion_id',$idOrdProd->id)->get();
            return $dato;

          }

          public function getListReqManoObraProduc(Request $request){
            $idReqMateriales = RequerimientosMateriales::where('codigo', $request->codReqMat)->first();
            $idOrdProd = InformeProduccion::where('pk_ReqMateriales',$idReqMateriales->id)->first();

            $dato = InfoProduccionManoObra::where('informeproduccion_id',$idOrdProd->id)->get();
            return $dato;
          }


          public function getOtrosRequerimientosProduc(Request $request){
            $idReqMateriales = RequerimientosMateriales::where('codigo', $request->codReqMat)->first();
            $idOrdProd = InformeProduccion::where('pk_ReqMateriales',$idReqMateriales->id)->first();
            $dato = InfoProduccionOtrosRequerimientos::where('informeproduccion_id',$idOrdProd->id)->get();
            return $dato;
          }

          public function list(Request $request){

            if (is_null($request->dFecha)  && is_null($request->nIdprod)) {
                $dato = InformeProduccion::with('producto', 'producto.marca', 'producto.familia', 'producto.material', 'producto.modelotipo', 'producto.subfamilia', 'producto.homologacion', 'unidmedida', 'cliente')->get();
                return $dato;
            }
            if (is_null($request->dFecha)) {
                $dato = InformeProduccion::with('producto', 'producto.marca', 'producto.familia', 'producto.material', 'producto.modelotipo', 'producto.subfamilia', 'producto.homologacion', 'unidmedida', 'cliente')->where('producto_id', $request->nIdprod)->get();
                return $dato;
            }

            if (is_null($request->nIdprod)) {
                $dato = InformeProduccion::with('producto', 'producto.marca', 'producto.familia', 'producto.material', 'producto.modelotipo', 'producto.subfamilia', 'producto.homologacion', 'unidmedida', 'cliente')->where('fecha', $request->dFecha)->get();
                return $dato;
            }

    }

    public function saveReqMateriales(Request $request){

        $formatreq = date("Y-m-d");

        $reqMat= RequerimientosMateriales::where('codigo', $request->codRequMateriales)->first();
        $ordenproduc = InformeProduccion::where('pk_ReqMateriales', $reqMat->id)->first();
        $InfoProduccionMaterial = new InfoProduccionMaterial();
        $InfoProduccionMaterial->informeproduccion_id = $ordenproduc->id;
        $InfoProduccionMaterial->producto_id = $request->nIdmaterial;
        $InfoProduccionMaterial->cantidad = $request->cCantMaterial;
        $InfoProduccionMaterial->unidmedida_id = $request->nIdUnidMedMat;
        $InfoProduccionMaterial->fecha = $formatreq;
        $InfoProduccionMaterial->costunit = 0.00;
        $InfoProduccionMaterial->total = 0.00;
        $InfoProduccionMaterial->save();
    }

    public function saveMObra(Request $request){
    $reqMat= RequerimientosMateriales::where('codigo', $request->codRequMateriales)->first();
    $ordenproduc = InformeProduccion::where('pk_ReqMateriales', $reqMat->id)->first();
    $InfoProduccionManoObra = new  InfoProduccionManoObra();
    $InfoProduccionManoObra->informeproduccion_id = $ordenproduc->id;
    $InfoProduccionManoObra->personal = strtoupper($request->cPersonal);
    $InfoProduccionManoObra->dias = $request->cDiasMObra;
    $InfoProduccionManoObra->horas = $request->cHorasMObra;
    $InfoProduccionManoObra->save();
    }

    public function saveOtrosRequerimientos(Request $request){
        $reqMat= RequerimientosMateriales::where('codigo', $request->codRequMateriales)->first();
        $ordenproduc = InformeProduccion::where('pk_ReqMateriales', $reqMat->id)->first();
       $InfoProduccionOtrosRequerimientos = new InfoProduccionOtrosRequerimientos();
       $InfoProduccionOtrosRequerimientos->informeproduccion_id = $ordenproduc->id;
       $InfoProduccionOtrosRequerimientos->descripcion = strtoupper($request->cDescripcion);
       $InfoProduccionOtrosRequerimientos->cantidad = strtoupper($request->cCantidadReq);
       $InfoProduccionOtrosRequerimientos->save();

    }
    public function DeleteReqMateriales(Request $request){
      $InfoProduccionMaterial = InfoProduccionMaterial::where('id',$request->item)->first();
      $InfoProduccionMaterial->delete();
    }

    public function DeleteManodeObra(Request $request){
        $InfoProduccionManoObra = InfoProduccionManoObra::where('id',$request->item)->first();
        $InfoProduccionManoObra->delete();

    }

    public function DeleteOtrosReque(Request $request){
        $InfoProduccionOtrosRequerimientos = InfoProduccionOtrosRequerimientos::where('id',$request->item)->first();
        $InfoProduccionOtrosRequerimientos->delete();
    }

    public function setGenerarInfoProduccionPdf(Request $request)
    {

        $idReqMateriales = $request->get("params")['item'];
        $InfoProduccion = InformeProduccion::with('producto', 'producto.marca', 'producto.familia', 'producto.material', 'producto.modelotipo', 'producto.subfamilia', 'producto.homologacion', 'unidmedida', 'cliente','requerimiento_materiales')->where('id', $idReqMateriales)->first();
        $InfoProduccionMaterial = InfoProduccionMaterial::with('producto')->where('informeproduccion_id', $idReqMateriales)->get();
        $InfoProduccionManoObra = InfoProduccionManoObra::where('informeproduccion_id', $idReqMateriales)->get();
        $InfoProduccionOtrosRequerimientos = InfoProduccionOtrosRequerimientos::where('informeproduccion_id', $idReqMateriales)->get();

        $logo = asset('img/logo.gif');


        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('reporte.infoProduccion.reporte', [
            'logo' => $logo,
            'InfoProduccion' => $InfoProduccion,
            'InfoProduccionMaterial' => $InfoProduccionMaterial,
            'InfoProduccionManoObra' => $InfoProduccionManoObra,
            'InfoProduccionOtrosRequerimientos' => $InfoProduccionOtrosRequerimientos,

        ]);
        return $pdf->download('invoice.pdf');
    }

}
