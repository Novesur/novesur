<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
<table width="100%" border="0">
  <tr>
    <td>  <img src="{{$logo}}" alt="" alt="" style=" width: 200px; height: 70px; padding-left: 25px"/></td>

  </tr>
  <tr>
    <td align="center"><strong>REQUERIMIENTOS MATERIALES Nr° {{$RequerimientosMateriales->codigo}}</strong></td>
  </tr>
</table>
<table width="100%" border="0">
  <tr>
    <td width="25%"><strong>MES/AÑO/FECHA :</strong></td>
    <td colspan="3">  {{date('d-m-Y', strtotime($RequerimientosMateriales->fecha))}}</td>
  </tr>

  <tr>
    <td><strong>CODIGO PRODUCTO :</strong></td>
    <td colspan="3">{{$RequerimientosMateriales->producto->codigo}}</td>
  </tr>
  <tr>
    <td><strong>PRODUCTO :</strong></td>
    <td colspan="3">{{$RequerimientosMateriales->producto->familia->nombre .' '. $RequerimientosMateriales->producto->subfamilia->nombre .', MODELO '. $RequerimientosMateriales->producto->modelotipo->nombre .', MATERIAL '. $RequerimientosMateriales->producto->material->nombre .', MARCA '. $RequerimientosMateriales->producto->marca->nombre.', - '. $RequerimientosMateriales->producto->homologacion->nombre}}</td>
  </tr>
  <tr>
    <td><strong>CANTIDAD :</strong></td>
    <td colspan="3">{{$RequerimientosMateriales->cantidad}}</td>
  </tr>
  @if ($RequerimientosMateriales->cliente->razonsocial == 'NINGUNO')
  <tr>
    <td><strong>ALMACEN:</strong></td>
    <td colspan="3">{{$RequerimientosMateriales->almacen->nombre}}</td>
  </tr>
  @else
  <tr>
    <td><strong>CLIENTE-REF :</strong></td>
    <td colspan="3">{{$RequerimientosMateriales->cliente->razonsocial}}</td>
  </tr>
  @endif

  <tr>
    <td><strong>FECHA INICIO :</strong></td>
    <td width="31%">{{date('d-m-Y', strtotime($RequerimientosMateriales->fechainicio))}}</td>
    <td width="23%"><strong>FECHA FINAL :</strong></td>
    <td width="30%"> {{date('d-m-Y', strtotime($RequerimientosMateriales->fechafinal))}}</td>
  </tr>
  <tr>
    <td><strong>DURACION :</strong></td>
    <td colspan="3">{{$RequerimientosMateriales->duracion}}</td>
  </tr>
</table>
<table width="100%" border="1">
    <tr>
      <td colspan="4" align="center" bgcolor="#33CCFF"><strong></strong><strong>REQUERIMIENTO MATERIALES</strong></td>
    </tr>
  <tr>
    <td width="16%" align="center" bgcolor="#CCCCCC"><strong>ITEM</strong></td>
    <td width="58%" align="center" bgcolor="#CCCCCC"><strong>DESCRIPCION</strong></td>
    <td width="12%" align="center" bgcolor="#CCCCCC"><strong>U.M</strong></td>
    <td width="14%" align="center" bgcolor="#CCCCCC"><strong>CANTIDAD</strong></td>
  </tr>
  @if($MaterialReqMateriales) @foreach ($MaterialReqMateriales as $data)
  <tr>
    <td align="center">{{$data->producto->codigo}}</td>
    <td align="center">{{$data->producto->familia->nombre }}</td>
    <td align="center">{{$data->unidmedida->nombre }}</td>
    <td align="center">{{$data->cantidad}}</td>
  </tr>
  @endforeach @endif
</table>
<table width="100%" border="1">
  <tr>
    <td width="74%" align="center" bgcolor="#33CCFF"><strong>REQUERIMIENTO MANO DE OBRA (DIAS, HORAS, HOMBRE)</strong></td>
    <td width="12%" align="center" bgcolor="#33CCFF"><strong>HORAS</strong></td>
    <td width="14%" align="center" bgcolor="#33CCFF"><strong>DIAS</strong></td>
  </tr>
  @if($ManoObraReqmateriales) @foreach ($ManoObraReqmateriales as $datamaterial)
  <tr>
    <td align="center">{{$datamaterial->personal}}</td>
    <td align="center">{{$datamaterial->horas}}</td>
    <td align="center">{{$datamaterial->dias}}</td>
  </tr>
  @endforeach @endif
</table>
<table width="100%" border="1">
    <tr>
      <td width="51%" align="center" bgcolor="#33CCFF"><strong>OTROS REQUERIMIENTOS</strong></td>
      <td width="49%" align="center" bgcolor="#33CCFF"><strong>DESCRIPCION</strong></td>
    </tr>
    @if($OtrosRequerimientosReqMateriales) @foreach ($OtrosRequerimientosReqMateriales as $dataRque)
    <tr>
      <td align="center">{{$dataRque->descripcion}}</td>
      <td align="center">{{$dataRque->cantidad}}</td>
    </tr>
    @endforeach @endif
  </table>
<table width="100%" border="0">
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><strong>V-B RESPONSABLE PRODUCCION</strong></td>
  </tr>
</table>
<p>&nbsp;</p>
<p><br />
</p>
</body>
</html>
