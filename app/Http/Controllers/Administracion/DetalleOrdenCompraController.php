<?php

namespace App\Http\Controllers\Administracion;

use App\Detalleordencompra;
use App\Http\Controllers\Controller;
use App\Ordencompra;
use Illuminate\Http\Request;

class DetalleOrdenCompraController extends Controller
{
    public function view(Request $request){

        $dato = Detalleordencompra::with('ordencompras','unidmedida','producto', 'producto.marca', 'producto.familia', 'producto.material', 'producto.modelotipo', 'producto.subfamilia')->where('ordencompras_id', $request->item)->get();
        return $dato;
    }

    public function CambiarEstadoDetalleOC(Request $request){
        $DetalleOC = Detalleordencompra::where('id',$request->nIdDetalleOC)->first();
        if($DetalleOC){
            $DetalleOC->ordencompras_id = $DetalleOC->ordencompras_id;
            $DetalleOC->producto_id = $DetalleOC->producto_id;
            $DetalleOC->cantidad = $DetalleOC->cantidad;
            $DetalleOC->unidmedida_id = $DetalleOC->unidmedida_id;
            $DetalleOC->punit = $DetalleOC->punit;
            $DetalleOC->estado = $request->cEstado;
            $DetalleOC->save();
        }

    }
    public function setMandarValorDetalleParteIngresoXId(Request $request){
        $dato = Detalleordencompra::where('id', $request->item)->first();
            return  $dato;
        }

    public function setEditarCantidadParteIngre(Request $request){
        $detalleOc = Detalleordencompra::where('id', $request->item)->first();


        if($request->cCantidadModal > $detalleOc->cantidad){
            return response()->json(['message' => 'La cantidad supera a lo solicitado', 'icon' => 'danger'], 200);
        }else{
            $valor = $detalleOc->cantidadKardex - $request->cCantidadModal;
            if ($valor >= 0) {
                Detalleordencompra::where('id', $request->item)->update(['cantidadKardex' => $valor  ]);
                return response()->json(['message' => 'La cantidad editada', 'icon' => 'success'], 200);
            }


        }
    }

    public function addOrdenEdit(Request $request){


        $ordenCompra = Ordencompra::where('codigo', $request->nidOrdenCompra)->first();
        $detalleOrdenCompraData = Detalleordencompra::where('ordencompras_id', $ordenCompra->id)->first();

        $ordenCompra->codigo =  $ordenCompra->codigo;
        $ordenCompra->Femision =  $ordenCompra->Femision;
        $ordenCompra->Referencia =  $ordenCompra->Referencia;
        $ordenCompra->proveedor_id =  $ordenCompra->proveedor_id;
        $ordenCompra->Fentrega =  $ordenCompra->Fentrega;
        $ordenCompra->LugarEntrega =  $request->cLEntrega;
        $ordenCompra->tipordercompra_id =  $ordenCompra->tipordercompra_id;
        $ordenCompra->pago_id =  $request->nIdTipoPago;
        $ordenCompra->user_id =  $ordenCompra->user_id;
        $ordenCompra->estadoordencompra_id =  $ordenCompra->estadoordencompra_id;
        $ordenCompra->observacion =  $request->cObservacion;
        $ordenCompra->save();

        $detalleOrdenCompra = new Detalleordencompra;
        $detalleOrdenCompra->ordencompras_id = $ordenCompra->id;
        $detalleOrdenCompra->producto_id = $request->nIdprod;
        $detalleOrdenCompra->cantidad = $request->cCantidad;
        $detalleOrdenCompra->cantidadKardex = $request->cCantidad;
        $detalleOrdenCompra->unidmedida_id = $request->nIdUnidMed;
        $detalleOrdenCompra->punit = $request-> cPrecio;
        $detalleOrdenCompra->estado =  $detalleOrdenCompraData->estado;
        $detalleOrdenCompra->save();

    }

    public function DeleteItemDetalleOrdenCompra(Request $request){
       $detalle = Detalleordencompra::find($request->item);
       $detalle->delete();

    }

    public function CargaDetalleOrdenCompraEdit(Request $request){

        $data = Detalleordencompra::find($request->item);
     return $data;

    }

    public function ModalSaveItemsDetalleOC(Request $request){
        $detalleOrdenCompra = Detalleordencompra::find($request->id);
        $detalleOrdenCompra->ordencompras_id = $detalleOrdenCompra->ordencompras_id;
        $detalleOrdenCompra->producto_id = $request->nIdprodEdit;
        $detalleOrdenCompra->cantidad = $request->cCantidadEdit;
        $detalleOrdenCompra->cantidadKardex = $request->cCantidadEdit;
        $detalleOrdenCompra->unidmedida_id = $request->nIdUnidMedEdit;
        $detalleOrdenCompra->punit = $request->cPUnitEdit;
        $detalleOrdenCompra->estado = $detalleOrdenCompra->estado;
        $detalleOrdenCompra->save();
    }
}
