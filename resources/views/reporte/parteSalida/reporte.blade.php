<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
<table width="100%" border="0">
  <tr>

    <td width="18%" rowspan="2"><img src="{{$logo}}" width="285" height="81" alt="fghf" /></td>
    <td width="82%">&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><b>PAPELETA DE AUTORIZACION DE SALIDA</b></td>
  </tr>
</table>
<table width="100%" border="0">
  <tr>
    <td width="30%"><b>NOMBRE Y APELLIDOS :</b></td>
    <td width="70%"> {{$parteSalida->user->firstname}} {{$parteSalida->user->secondname}} {{$parteSalida->user->lastname}}</td>

  </tr>
  <tr>
    <td><b>AREA DE TRABAJO :</b></td>
    <td> COMERCIAL</td>
  </tr>
</table>
<table width="100%" border="0">
  <tr>
    <td align="center"><b>FECHA :</b></td>
    <td align="center"> <b>HORA DE SALIDA :</b></td>
    <td align="center"> <b>HORA DE RETORNO :</b></td>
  </tr>
  <tr>
    <td align="center">{{date('d-m-Y', strtotime($parteSalida->fecha))}}</td>
    <td align="center">{{$parteSalida->horasalida}}</td>
    <td align="center"> {{$parteSalida->horaretorno}}</td>
  </tr>
</table>
<table width="100%" border="0">
  <tr>
    <td width="13%"><b>MOTIVO :</b></td>
    <td width="87%"> {{$parteSalida->motivopapeletasalida->nombre}}</td>
  </tr>
</table>
<table width="100%" border="1">
  <tr>
    <td bgcolor="#FFFFFF"><b>FUNDAMENTO :</b></td>
  </tr>
  <tr>
    <td>{{$detalleParteSalida->fundamento}}</td>
  </tr>
</table>
<p>&nbsp;</p>
<table width="100%" border="0">
  <tr>
    <td width="20%">&nbsp;</td>
    <td width="25%">&nbsp;</td>
    <td width="21%">&nbsp;</td>
    <td width="34%">&nbsp;</td>
  </tr>
  <tr>
    <td height="23">&nbsp;</td>
    <td><b>JEFE INMEDIATO</b></td>
    <td><b>SOLICITANTE</b></td>
    <td>&nbsp;</td>
  </tr>
</table>
<p>&nbsp;</p>
<hr  >
</body>




<body>
    <table width="100%" border="0">
      <tr>

        <td width="18%" rowspan="2"><img src="{{$logo}}" width="285" height="81" alt="fghf" /></td>
        <td width="82%">&nbsp;</td>
      </tr>
      <tr>
        <td align="center"><b>PAPELETA DE AUTORIZACION DE SALIDA</b></td>
      </tr>
    </table>
    <table width="100%" border="0">
      <tr>
        <td width="30%"><b>NOMBRE Y APELLIDOS :</b></td>
        <td width="70%"> {{$parteSalida->user->firstname}} {{$parteSalida->user->secondname}} {{$parteSalida->user->lastname}}</td>

      </tr>
      <tr>
        <td><b>AREA DE TRABAJO :</b></td>
        <td> COMERCIAL</td>
      </tr>
    </table>
    <table width="100%" border="0">
      <tr>
        <td align="center"><b>FECHA :</b></td>
        <td align="center"> <b>HORA DE SALIDA :</b></td>
        <td align="center"> <b>HORA DE RETORNO :</b></td>
      </tr>
      <tr>
        <td align="center">{{date('d-m-Y', strtotime($parteSalida->fecha))}}</td>
        <td align="center">{{$parteSalida->horasalida}}</td>
        <td align="center"> {{$parteSalida->horaretorno}}</td>
      </tr>
    </table>
    <table width="100%" border="0">
      <tr>
        <td width="13%"><b>MOTIVO :</b></td>
        <td width="87%"> {{$parteSalida->motivopapeletasalida->nombre}}</td>
      </tr>
    </table>
    <table width="100%" border="1">
      <tr>
        <td bgcolor="#FFFFFF"><b>FUNDAMENTO :</b></td>
      </tr>
      <tr>
        <td>{{$detalleParteSalida->fundamento}}</td>
      </tr>
    </table>
    <p>&nbsp;</p>
    <table width="100%" border="0">
      <tr>
        <td width="20%">&nbsp;</td>
        <td width="25%">&nbsp;</td>
        <td width="21%">&nbsp;</td>
        <td width="34%">&nbsp;</td>
      </tr>
      <tr>
        <td height="23">&nbsp;</td>
        <td><b>JEFE INMEDIATO</b></td>
        <td><b>SOLICITANTE</b></td>
        <td>&nbsp;</td>
      </tr>
    </table>
    <p>&nbsp;</p>
    </body>
</html>
