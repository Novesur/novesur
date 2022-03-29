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
            <th>Vendedor</th>
            <th>cant. Entrada</th>
            <th>Entrada</th>
            <th>cant. Segundo</th>
            <th>Segundo</th>
            <th>cant. Extra</th>
            <th>Extra</th>
            <th>Tipo de Menu</th>
            <th>Observación</th>
        </tr>
        </thead>
        <tbody>
    @foreach($DetalleMenu as $data)

            <tr>
                <td>{{$data->menu->user->firstname}} {{$data->menu->user->lastname}} {{$data->menu->user->secondname}}</td>
                <td>{{$data->cantEntrada}} </td>
                <td>{{$data->menuentrada->nombre}} </td>
                <td>{{$data->cantSegundo}} </td>
                <td>{{$data->menusegundo->nombre}} </td>
                <td>{{$data->cantExtra}} </td>
                <td>{{$data->menuextra->nombre}} </td>
                <td>{{$data->tipomenu->nombre}} </td>
                <td>{{$data->menu->observacion}} </td>

            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
