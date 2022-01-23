<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Parte de Salida</title>
</head>

<body>
<table width="100%" border="0">
  <tr>
    <td width="35%"><img src="{{$logo}}" width="300" height="92" alt="logo" /></td>

  </tr>
  <tr style="justify-content: space-between;">
    <td colspan="2" align="center"><strong>PARTE DE SALIDA - ALMACEN</strong></td>
  </tr>
</table>
<table width="100%" border="0">
  <tr>
    <td width="21%" height="25" align="center"><strong>RUC . 20492421406</strong></td>
    <td width="55%">&nbsp;</td>
    <td width="24%" align="center"><strong>Nº {{$parteSalida->codigo}}</strong></td>
  </tr>
</table>
<table width="100%" border="0">
  <tr>
    <td width="30%">&nbsp;</td>
    <td width="49%" align="right" style="font-size: 12px"><strong>FECHA : </strong></td>
    <td width="21%" style="font-size: 10px">{{$parteSalida->Fecha}}</td>
  </tr>
</table>
<table width="100%" border="0">
  <tr>
    <td width="12%" style="font-size: 0.8em"><strong>CLIENTE :</strong></td>
    <td width="46%" style="font-size: 0.7em">{{$parteSalida->cliente->razonsocial}}</td>
    <td width="20%" style="font-size: 0.8em"><strong>G/REMISION Nº :</strong></td>
    <td width="32%" style="font-size: 0.7em">{{$parteSalida->Nroguia}}</td>
  </tr>
</table>
<table width="100%" border="0">
  <tr>
    <td width="26%" style="font-size: 0.8em"><strong>TIPO MOVIMIENTO :</strong></td>
    <td width="74%" style="font-size: 0.7em">{{$parteSalida->motivo->nombre}}</td>
  </tr>
</table>
<table width="100%" border="0">
  <tr>
    <td width="24%" style="font-size: 0.8em" ><strong>VENDEDOR :</strong></td>
    <td width="36%" style="font-size: 0.7em">{{$parteSalida->user->nombre .' '. $parteSalida->user->firstname .' '.$parteSalida->user->secondname }}</td>
    <td width="22%" style="font-size: 0.8em"><strong>FACTURA :</strong></td>
    <td width="38%" style="font-size: 0.7em">{{$parteSalida->Nrofactura}}</td>
  </tr>
</table>
<br>

<table width="100%" border="1">
    <tr>
        <td width="18%" align="center" bgcolor="#FFFFFF"><strong>CODIGO</strong></td>
        <td width="12%" align="center" bgcolor="#FFFFFF"><strong>CANTIDAD</strong></td>
        <td width="20%" align="center" bgcolor="#FFFFFF"><strong>UNID.  MEDIDA</strong></td>
        <td width="50%" align="center" bgcolor="#FFFFFF"><strong>DESCRIPCION</strong></td>
    </tr>
    <tr>
      @if($detalleParteSalida) @foreach ($detalleParteSalida as $data)
      <td style="font-size: 12px; text-align: center;">{{$data->producto->codigo}}</td>
      <td style="font-size: 12px ; text-align: center;">{{$data->cantidad}}</td>
      <td style="font-size: 12px; text-align: center;">{{$data->unidmedida->nombre}}</td>
      <td style="font-size: 12px; text-align: center;">{{$data->producto->familia->nombre .' '. $data->producto->subfamilia->nombre .', MODELO '. $data->producto->modelotipo->nombre .', MATERIAL '. $data->producto->material->nombre .', MARCA '. $data->producto->marca->nombre.', - '. $data->producto->homologacion->nombre}}</td>
  </tr>
  @endforeach
  @endif
</table>
<table width="100%" border="0">
  <tr>
    <td width="17%" align="center"><strong>Observaciones :</strong></td>
    <td width="83%" style="font-size: 0.7em">{{$parteSalida->observacion}}</td>
  </tr>
</table>
<p>&nbsp;</p>

<footer>
  <table width="100%" border="0">
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="center"><strong>VºBº Almacen</strong></td>
      <td align="center"><strong>V°B° Asesor Ventas</strong></td>
      <td align="center"><strong>Recibi Conforme</strong></td>
    </tr>
  </table>
</footer>
</body>
</html>
