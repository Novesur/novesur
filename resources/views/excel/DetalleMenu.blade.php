<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table>
        <thead>
        <tr>
            <th>Fecha</th>
            <th>Vendedor</th>
            <th>cant. Entrada</th>
            <th>Entrada</th>
            <th>Observación_Entrada</th>
            <th>cant. Segundo</th>
            <th>Segundo</th>
            <th>Observación_Segundo</th>
            <th>cant. Extra</th>
            <th>Extra</th>
            <th>Observación_Extra</th>
            <th>Tipo de Menu</th>
        </tr>
        </thead>
        <tbody>
    @foreach($DetalleMenu as $data)

            <tr>
                <td>{{ date('d-m-Y', strtotime($data->menu->fecha)) }}</td>
                <td>{{strtoupper($data->menu->user->secondname)}} {{strtoupper($data->menu->user->lastname)}}   {{strtoupper($data->menu->user->firstname)}}</td>
                <td>{{$data->cant_entrada}} </td>
                <td>{{$data->plato_entrada->nombre}} </td>
                <td>{{$data->observacionEntrada}} </td>
                <td>{{$data->cant_segundo}} </td>
                <td>{{$data->plato_segundo->nombre}} </td>
                <td>{{$data->observacionSegundo}} </td>
                <td>{{$data->cant_extra}} </td>
                <td>{{$data->plato_extra->nombre}} </td>
                <td>{{$data->observacionExtra}} </td>
                <td>{{$data->menu->tipomenu->nombre}} </td>

            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
