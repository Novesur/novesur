<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>
        @page{
            margin: 1.3rem;
            margin-top:1.9rem;
            padding: 1rem;
        }
        body {
            margin: 0px;
        }
        * {
            font-family: verdana, arial, sans-serif;
        }
        .cabecera {
            background-color: #FEFEFE;
            color: #000000;
            padding: 2rem;
            padding-top: .2rem;
            padding-bottom: 0px;
        }
        .cabecera .logo{
            margin: 5px;
        }
        .cabecera table {
            padding: 1px;
            margin-bottom: .2rem;
        }
        table {
            font-size: x-small
        }
        tfoot tr td{
            font-weight: bold;
            font-size: x-small;
        }
    </style>
</head>
<body>



<table width="100%" border="0">
        <tr>
            <td>  <img src="{{$logo}}" alt="" alt="" style=" width: 200px; height: 70px; padding-left: 25px"/></td>

        </tr>

</table>

      <table width="100%" border="0">
        <tr>
         <td colspan="5" align="center" style="border: 1px; background-color: rgb(175, 243, 166)" ><h3><strong>ORDEN DE COMPRA  Nº {{$orderCompra->codigo }}</strong></h3></td>


</tr>
            <tr >
          <td colspan="5" align="center" valign="middle" style="font-size: 10px" ><strong>REFERENCIA : </strong>{{$orderCompra->Referencia}} </td>
        </tr>
        <tr >
            <td colspan="2" align="center" valign="middle" >&nbsp;</td>
            <td align="left" valign="middle" style="margin-left: 50px" style="font-size: 10px"><strong>FECHA EMISION</strong></td>
            <td  style="padding-right:100px; font-size: 10px">  {{date('d-m-Y', strtotime($orderCompra->Femision))}}</td>
        </tr>

        <tr >
          <td style="font-size: 11px"><strong>PROVEEDOR</strong></td>
          <td>&nbsp;</td>
          <td  style="font-size: 11px"><strong>FACTURAR A  </strong></td>
          <td>&nbsp;</td>
        </tr>

        <tr>
            <td align="left" style="font-size: 11px"><strong>SEÑOR(ES) :</strong></td>
            <td style="font-size: 10px">{{$orderCompra->proveedor->nombre}}</td>

            <td><strong style="font-size: 11px">SEÑOR(ES) ::</strong></td>
            <td style="font-size: 11px">    INVERSIONES NOVESUR S.A.C.</td>
        </tr>
        <tr>
            <td align="left"><strong>RUC :</strong></td>
            <td style="font-size: 10px">{{$orderCompra->proveedor->ruc}}</td>
            <td style="font-size: 11px"><strong>R.U.C. :</strong></td>
            <td style="font-size: 10px">20492421406</td>
        </tr>


          <tr>
            <td align="left" style="font-size: 11px"><strong>DIRECCION :</strong></td>
            <td style="font-size: 10px">{{$orderCompra->proveedor->direccion}}</td>
            <td style="font-size: 11px"><strong>DIRECCIÓN:</strong></td>
            <td style="font-size: 10px">JR. MONTE ABETO NRO. 376 URB. MONTERRICO SUR LIMA - LIMA - SANTIAGO DE SURCO</td>
          </tr>

          <tr>
            <td align="left" style="font-size: 11px"><strong>TELEFONO:</strong></td>
            <td style="font-size: 10px">{{$orderCompra->proveedor->telefono}}</td>
            <td style="font-size: 11px"><strong>TELÉFONO :</strong></td>
            <td style="font-size: 10px">967708348</td>

          </tr>

          <tr>
            <td align="left" style="font-size: 11px"><strong>EMAIL : </strong></td>
            <td style="font-size: 10px">{{$orderCompra->proveedor->email}}</td>


            <td style="font-size: 11px"><strong>E - MAIL:</strong></td>
            <td style="font-size: 10px">asistente.comercial@novesur.com</td>


          </tr>
          <tr>
            <td align="left" style="font-size: 11px"><strong>CONTACTO : </strong></td>
            <td style="font-size: 10px">{{$orderCompra->proveedor->contacto}}</td>
            <td style="font-size: 11px"><strong>CONTACTO :</strong></td>
            <td style="font-size: 10px"> JOSELYN VERA CIEZA</td>
          </tr>
          <tr>
            <td align="left" style="font-size: 11px"><strong>NRO CTA01  S/. :</strong></td>
            <td style="font-size: 10px">{{$orderCompra->proveedor->nrocuenta1}}</td>

          </tr>
          <tr>
            <td align="left" style="font-size: 11px"><strong>NRO CTA02  S/. :</strong></td>
            <td style="font-size: 10px">{{$orderCompra->proveedor->nrocuenta2}}</td>
          </tr>

      </table>

<h5><center></center></h5>

 <table width="100%" border="1" >
        <tr>
          <td align="center" style="background-color:rgba(238, 229, 229, 0.719)"><strong>Nro</strong></td>
          <td align="center" style="background-color: rgba(238, 229, 229, 0.719)"><strong>CANT</strong></td>
          <td align="center" style="background-color: rgba(238, 229, 229, 0.719)"><strong>CODIGO</strong></td>
          <td align="center" style="background-color: rgba(238, 229, 229, 0.719)"><strong>DESCRIPCION DE MEDIDOR</strong></td>
          <td align="center" style="background-color: rgba(238, 229, 229, 0.719)"> <strong>P/UNIT</strong></td>
          <td align="center" style="background-color: rgba(238, 229, 229, 0.719)"><strong>Total S/IGV</strong></td>
        </tr>

@php
    $i=0;
@endphp
        @if($DetalleOrderCompra) @foreach ($DetalleOrderCompra as $data)
        <tr>
          <td align="center" style="font-size: 10px">@php
              echo $i = $i +1 ;
          @endphp</td>
        </td>
          <td align="center" style="font-size: 10px">{{$data->cantidad}}</td>
          <td align="center" style="font-size: 10px">{{$data->producto->codigo}}</td>
          <td align="center" style="font-size: 10px">  {{$data->producto->familia->nombre .' '. $data->producto->subfamilia->nombre .', MODELO '. $data->producto->modelotipo->nombre .', MATERIAL '. $data->producto->material->nombre .', MARCA '. $data->producto->marca->nombre.', - '. $data->producto->homologacion->nombre}}</td>
          <td align="center" style="font-size: 10px">{{$orderCompra->tipocambio->signo}} {{number_format($data->punit,4)  }}</td>

          <td align="right" style="font-size: 10px">{{$orderCompra->tipocambio->signo}} {{number_format($data->cantidad * $data->punit,2)}}</td>

        </tr>
        @endforeach @endif
        @php
            $subtotal = 0;
                foreach ($DetalleOrderCompra as $data){
                    $valor = ($data->cantidad * $data->punit);
                    $subtotal = $valor + $subtotal;
                }
                    $IGV = $subtotal * 0.18;
                    $total =  $subtotal + $IGV;
        @endphp
        <tr>
          <td colspan="4" rowspan="3" align="center">&nbsp;</td>
          <td align="center" style="background-color: rgba(238, 229, 229, 0.719); font-size: 11px"><strong>SUBTOTAL</strong></td>
          <td align="right" style="font-size: 10px">{{$orderCompra->tipocambio->signo}} {{number_format($subtotal,2)}}</td>
        </tr>

          <td align="center" style="background-color: rgba(238, 229, 229, 0.719); font-size: 11px"><strong>IGV 18%</strong></td>
          <td align="right" style="font-size: 10px">{{$orderCompra->tipocambio->signo}}{{number_format($IGV,2)}}</td>
        </tr>
        <tr>
          <td align="center" style="background-color: rgba(238, 229, 229, 0.719); font-size: 11px"><strong>TOTAL GENERAL</strong></td>
          <td align="right" style="font-size: 10px">{{$orderCompra->tipocambio->signo}}{{number_format($total,2)}}</td>
        </tr>

</table>
<br>
<table width="100%" border="0">

        <tr>
          <td width="20%" style="font-size: 11px"><strong>Observaciones : </strong></td>
          <td colspan="2" style="font-size: 10px">{{$orderCompra->observacion}}</td>
        </tr>
          <tr>
          <td style="font-size: 11px"><strong>CONDICIONES:</strong></td>
          <td colspan="2">&nbsp;</td>
        </tr>


        <tr>
            <td>&nbsp;</td>
            <td width="30%" style="font-size: 11px"><strong>Fecha de Entrega :</strong></td>
            <td width="78%" style="font-size: 10px"> {{date('d-m-Y', strtotime($orderCompra->Fentrega))}}
            </td>
        </tr>

        <tr>
            <td>&nbsp;</td>
            <td style="font-size: 11px"><strong>Lugar de Entrega  : </strong></td>
            <td style="font-size: 10px"> {{$orderCompra->LugarEntrega}} </td>
        </tr>

        <tr>
            <td>&nbsp;</td>
            <td width="30%" style="font-size: 11px"><strong>Forma de pago :</strong></td>
            <td width="78%" style="font-size: 10px"> {{$orderCompra->pago->nombre}}
            </td>
        </tr>
        <tr>
          <td style="font-size: 11px"><b>NOTA :</b></td>
          <td colspan="2" style="font-size: 10px">En la GUIAS DE REMISIÓN y FACTURAS, deberán indicar el número de esta Orden de Compra.</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="2" style="font-size: 10px">La presente Orden de Compra carece de valor si no esta refenciada con sello y firma autorizada.</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="2" style="font-size: 10px">Cualquier enmienda o corrección invalida esta Orden de Compra.</td>
        </tr>

      </table>
<p>&nbsp;</p>
<p><br>
</p>
<table width="100%" border="0">
  <tr>
    <td width="33%" align="center"><b>Joselyn Vera Cieza</b></td>
    <td width="40%" align="center"><b>Lusi Principe Bayona</b></td>
    <td width="27%" align="center"><b>Alexander Diaz Vera</b></td>
  </tr>
  <tr>
    <td align="center"><b>V°B DPTO. DE LOGISTICA</b></td>
    <td align="center"><b>V°B GERENCIA AMD. Y FINANZAS</b></td>
    <td align="center"><b>V°B GERENCIA GENERAL</b></td>
  </tr>
</table>
<p><br>

</p>


</body>
</html>
