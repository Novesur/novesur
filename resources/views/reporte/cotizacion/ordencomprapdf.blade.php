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
<<<<<<< HEAD
        </tr>
=======
          </tr>
>>>>>>> 4a13a460a41f87b9f2c5aaced676425237f8ef8b

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
<<<<<<< HEAD


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
=======
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

<br>

   <table width="100%" border="1" align="center">
  <tr >
    <td colspan="2" style="text-align: center; font-size: 10px"><strong>PREFERENCIA DE PAGO :</strong></td>
    <td style="border-bottom:hidden; border-right-color:#FFF">&nbsp;</td>
    <td style="border-bottom-color:#FFF; border-right-color:#FFF; border-left-color:#FFF">&nbsp;</td>
    <td style="border-bottom-color:#FFF; border-left-color:#FFF">&nbsp;</td>
    </tr>


    @if ($orderCompra->pago_id == 4)
    <tr >
        <td width="14%">&nbsp;</td>
        <td style="border-top-color:rgb(8, 8, 8)">&nbsp;  </td>
        <td colspan="3">&nbsp;</td>
        </tr>
      <tr>
        <td style="font-size: 11px">Cheque Dif. a 30 dias</td>
        <td style="width: 30px"></td>
        <td width="30%" align="center" style="font-size: 10px"><strong>Alexander Díaz Vera</strong></td>
        <td width="30%" align="center" style="font-size: 10px"><strong>Lusi Principe Bayona</strong></td>
        <td style="text-align: center" style="font-size: 10px"><strong>Joselyn Vera Cieza</strong></td>
        </tr>
      <tr>
        <td style="font-size: 11px">Factura a 30 Días</td>
        <td>&nbsp;</td>
        <td align="center" style="font-size: 10px"><strong>VºBº GERENCIA GENERAL</strong></td>
        <td align="center" style="font-size: 10px"><strong>VºBº GERENCIA AMD. Y FINANZAS</strong></td>
        <td style="text-align: center ;font-size: 10px" ><strong>VºBº DPTO. DE LOGISTICA</strong></td>
        </tr>

        <tr>
            <td style="font-size: 11px">Factura a 7 Días</td>
            <td>&nbsp;</td>
            <td align="center" style="font-size: 10px">INVERSIONES NOVESUR S.A.C.</td>
            <td align="center" style="font-size: 10px">INVERSIONES NOVESUR S.A.C.</td>
            <td style="text-align: center" style="font-size: 10px">INVERSIONES NOVESUR S.A.C.</td>
            </tr>

      <tr>
        <td style="font-size: 11px">Trans. Bancaria</td>
        <td>&nbsp;</td>
        <td align="center" >&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td style="text-align: center">&nbsp;</td>
        </tr>

        <tr>
            <td style="font-size: 11px">50% - 50%</td>
            <td style="text-align:center;"> X </td>
            <td align="center">&nbsp;</td>
            <td align="center">&nbsp;</td>
            <td style="text-align: center">&nbsp;</td>
            </tr>


    @endif





    @if ($orderCompra->pago_id == 5)
    <tr >
        <td width="14%">&nbsp;</td>
        <td style="border-top-color:rgb(8, 8, 8)">&nbsp;  </td>
        <td colspan="3">&nbsp;</td>
        </tr>
      <tr>
        <td style="font-size: 11px">Cheque Dif. a 30 dias</td>
        <td style="width: 30px"></td>
        <td width="30%" align="center" style="font-size: 10px"><strong>Alexander Díaz Vera</strong></td>
        <td width="30%" align="center" style="font-size: 10px"><strong>Lusi Principe Bayona</strong></td>
        <td style="text-align: center" style="font-size: 10px"><strong>Joselyn Vera Cieza</strong></td>
        </tr>
      <tr>
        <td style="font-size: 11px">Factura a 30 Días</td>
        <td>&nbsp;</td>
        <td align="center" style="font-size: 10px"><strong>VºBº GERENCIA GENERAL</strong></td>
        <td align="center" style="font-size: 10px"><strong>VºBº GERENCIA AMD. Y FINANZAS</strong></td>
        <td style="text-align: center" style="font-size: 10px"><strong>VºBº DPTO. DE LOGISTICA</strong></td>
        </tr>

        <tr>
            <td style="font-size: 11px">Factura a 7 Días</td>
            <td style="text-align:center;"> X </td>
            <td align="center" style="font-size: 10px">INVERSIONES NOVESUR S.A.C.</td>
            <td align="center" style="font-size: 10px">INVERSIONES NOVESUR S.A.C.</td>
            <td style="text-align: center ;font-size: 10px">INVERSIONES NOVESUR S.A.C.</td>
            </tr>

      <tr>
        <td style="font-size: 11px">Trans. Bancaria</td>
        <td>&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td style="text-align: center">&nbsp;</td>
        </tr>

        <tr>
            <td style="font-size: 11px">50% - 50%</td>
            <td align="center">&nbsp;</td>
            <td align="center">&nbsp;</td>
            <td align="center">&nbsp;</td>
            <td style="text-align: center">&nbsp;</td>
        </tr>




    @endif

    @if ($orderCompra->pago_id == 1)
    <tr>
        <td height="30" style="font-size: 11px">Contado</td>
        <td style="border-top-color:rgb(8, 8, 8)">&nbsp;  </td>
        <td colspan="3">&nbsp;</td>
        </tr>
      <tr>
        <td>Cheque Dif. a 30 dias</td>
        <td style="width: 30px ; text-align:center;"> X </td>
        <td width="30%" align="center" style="font-size: 10px"><strong>Alexander Díaz Vera</strong></td>
        <td width="30%" align="center" style="font-size: 10px"><strong>Lusi Principe Bayona</strong></td>
        <td style="text-align: center" style="font-size: 10px"><strong>Joselyn Vera Cieza</strong></td>
        </tr>
        <tr>
            <td>Factura a 7 Días</td>
            <td style="text-align:center;"> &nbsp; </td>
            <td align="center" style="font-size: 10px">INVERSIONES NOVESUR S.A.C.</td>
            <td align="center" style="font-size: 10px">INVERSIONES NOVESUR S.A.C.</td>
            <td style="text-align: center" style="font-size: 10px">INVERSIONES NOVESUR S.A.C.</td>
            </tr>

      <tr>
      <tr>
        <td>Factura a 30 Días</td>
        <td>&nbsp;</td>
        <td align="center" style="font-size: 10px"><strong>VºBº GERENCIA GENERAL</strong></td>
        <td align="center" style="font-size: 10px"><strong>VºBº GERENCIA AMD. Y FINANZAS</strong></td>
        <td style="text-align: center" style="font-size: 10px"><strong>VºBº DPTO. DE LOGISTICA</strong></td>
        </tr>
      <tr>

        <td style="font-size: 11px">Trans. Bancaria</td>
        <td>&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td style="text-align: center">&nbsp;</td>
        </tr>

        <tr>
            <td style="font-size: 11px">50% - 50%</td>
            <td align="center">&nbsp;</td>
            <td align="center">&nbsp;</td>
            <td align="center">&nbsp;</td>
            <td style="text-align: center">&nbsp;</td>
        </tr>
    @endif

    @if ($orderCompra->pago_id == 2)
    <tr>
        <td style="width: 1px ;font-size: 10px">Contado</td>
        <td>&nbsp;  </td>
        <td colspan="3">&nbsp;</td>
        </tr>
      <tr>
        <td height="30" style="font-size: 10px">Cheque Dif. a 30 dias</td>
        <td style="width: 30px ">&nbsp;  </td>
        <td width="30%" align="center" style="font-size: 10px"><strong>Alexander Díaz Vera</strong></td>
        <td width="30%" align="center" style="font-size: 10px"><strong>Lusi Principe Bayona</strong></td>
        <td style="text-align: center" style="font-size: 10px"><strong>Joselyn Vera Cieza</strong></td>
>>>>>>> 4a13a460a41f87b9f2c5aaced676425237f8ef8b
        </tr>
        <tr>
<<<<<<< HEAD
          <td style="font-size: 11px"><b>NOTA :</b></td>
          <td colspan="2" style="font-size: 10px">En la GUIAS DE REMISIÓN y FACTURAS, deberán indicar el número de esta Orden de Compra.</td>
=======
            <td style="font-size: 11px">Factura a 7 Días</td>
            <td style="text-align:center;"> &nbsp; </td>
            <td align="center" style="font-size: 10px">INVERSIONES NOVESUR S.A.C.</td>
            <td align="center" style="font-size: 10px">INVERSIONES NOVESUR S.A.C.</td>
            <td style="text-align: center" style="font-size: 10px">INVERSIONES NOVESUR S.A.C.</td>
            </tr>

      <tr>
        <td style="font-size: 11px">Factura a 30 Días</td>
        <td style="text-align:center;"> X </td>
        <td align="center" style="font-size: 10px"><strong>VºBº GERENCIA GENERAL</strong></td>
        <td align="center" style="font-size: 10px"><strong>VºBº GERENCIA AMD. Y FINANZAS</strong></td>
        <td style="text-align: center" style="font-size: 10px"><strong>VºBº DPTO. DE LOGISTICA</strong></td>
        </tr>
      <tr>
        <td style="font-size: 11px">Trans. Bancaria</td>
        <td>&nbsp;</td>
        <td align="center" style="font-size: 10px">INVERSIONES NOVESUR S.A.C.</td>
        <td align="center" style="font-size: 10px">INVERSIONES NOVESUR S.A.C.</td>
        <td style="text-align: center" style="font-size: 10px">INVERSIONES NOVESUR S.A.C.</td>
>>>>>>> 4a13a460a41f87b9f2c5aaced676425237f8ef8b
        </tr>
        <tr>
<<<<<<< HEAD
          <td>&nbsp;</td>
          <td colspan="2" style="font-size: 10px">La presente Orden de Compra carece de valor si no esta refenciada con sello y firma autorizada.</td>
=======
            <td style="font-size: 11px">50% - 50%</td>
            <td align="center">&nbsp;</td>
            <td align="center">&nbsp;</td>
            <td align="center">&nbsp;</td>
            <td style="text-align: center">&nbsp;</td>
        </tr>
    @endif

    @if ($orderCompra->pago_id == 7)
    <tr>
        <td height="30" style="height: 25px ;font-size: 11px">Contado</td>
        <td >&nbsp;  </td>
        <td colspan="3" style="border-top-color:#FFF">&nbsp;</td>
        </tr>
      <tr>
        <td style="height: 25px ;font-size: 10px">Cheque Dif. a 30 dias</td>
        <td style="width: 30px ">&nbsp;  </td>
        <td width="30%" align="center" style="font-size: 10px"><strong>Alexander Díaz Vera</strong></td>
        <td width="30%" align="center" style="font-size: 10px"><strong>Lusi Principe Bayona</strong></td>
        <td style="text-align: center" style="font-size: 10px"><strong>Joselyn Vera Cieza</strong></td>
        </tr>
        <tr>
            <td style="font-size: 11px">Factura a 7 Días</td>
            <td style="text-align:center;"> &nbsp; </td>
            <td align="center" style="font-size: 10px">INVERSIONES NOVESUR S.A.C.</td>
            <td align="center" style="font-size: 10px">INVERSIONES NOVESUR S.A.C.</td>
            <td style="text-align: center" style="font-size: 10px">INVERSIONES NOVESUR S.A.C.</td>
            </tr>


      <tr>
        <td style="height: 25px ;font-size: 11px">Factura a 30 Días</td>
        <td>&nbsp;  </td>
        <td align="center" style="font-size: 10px"><strong>VºBº GERENCIA GENERAL</strong></td>
        <td align="center" style="font-size: 10px"><strong>VºBº GERENCIA AMD. Y FINANZAS</strong></td>
        <td style="text-align: center" style="font-size: 10px"><strong>VºBº DPTO. DE LOGISTICA</strong></td>
        </tr>
      <tr>
        <td style="font-size: 11px">Trans. Bancaria</td>
        <td  style="text-align:center;" > X </td>
        <td align="center" style="font-size: 10px">INVERSIONES NOVESUR S.A.C.</td>
        <td align="center" style="font-size: 10px">INVERSIONES NOVESUR S.A.C.</td>
        <td style="text-align: center" style="font-size: 10px">INVERSIONES NOVESUR S.A.C.</td>
>>>>>>> 4a13a460a41f87b9f2c5aaced676425237f8ef8b
        </tr>
        <tr>
<<<<<<< HEAD
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
=======
            <td style="font-size: 11px">50% - 50%</td>
            <td align="center">&nbsp;</td>
            <td align="center">&nbsp;</td>
            <td align="center">&nbsp;</td>
            <td style="text-align: center">&nbsp;</td>
        </tr>
    @endif

    @if ($orderCompra->pago_id == 6)
    <tr>
        <td height="30" style="height: 25px ;font-size: 11px">Contado</td>
        <td align="center" > X  </td>
        <td colspan="3" style="border-top-color:#FFF">&nbsp;</td>
        </tr>
      <tr>
        <td style="height: 25px ;font-size: 11px">Cheque Dif. a 30 dias</td>
        <td style="width: 30px ">&nbsp;  </td>
        <td width="30%" align="center" style="font-size: 10px"><strong>Alexander Díaz Vera</strong></td>
        <td width="30%" align="center" style="font-size: 10px"><strong>Lusi Principe Bayona</strong></td>
        <td style="text-align: center" style="font-size: 10px"><strong>Joselyn Vera Cieza</strong></td>
        </tr>

        <tr>
            <td style="font-size: 11px">Factura a 7 Días</td>
            <td style="width: 30px ">&nbsp;  </td>
            <td align="center" style="font-size: 10px">INVERSIONES NOVESUR S.A.C.</td>
            <td align="center" style="font-size: 10px">INVERSIONES NOVESUR S.A.C.</td>
            <td style="text-align: center ;font-size: 10px">INVERSIONES NOVESUR S.A.C.</td>
            </tr>

      <tr>
        <td style="height: 25px ;font-size: 10px">Factura a 30 Días</td>
        <td>&nbsp;  </td>
        <td align="center" style="font-size: 10px"><strong>VºBº GERENCIA GENERAL</strong></td>
        <td align="center" style="font-size: 10px"><strong>VºBº GERENCIA AMD. Y FINANZAS</strong></td>
        <td style="text-align: center ;font-size: 10px"><strong>VºBº DPTO. DE LOGISTICA</strong></td>
        </tr>
      <tr>
        <td style="font-size: 10px">Trans. Bancaria</td>
        <td> &nbsp; </td>
        <td align="center">&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td style="text-align: center">&nbsp;</td>
        </tr>

        <tr>
            <td style="font-size: 10px">50% - 50%</td>
            <td align="center">&nbsp;</td>
            <td align="center">&nbsp;</td>
            <td align="center">&nbsp;</td>
            <td style="text-align: center">&nbsp;</td>
        </tr>
    @endif
>>>>>>> 4a13a460a41f87b9f2c5aaced676425237f8ef8b


</body>
</html>
