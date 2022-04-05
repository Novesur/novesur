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
            <th><b>Fecha</b></th>
            <th><b>Vendedor</b></th>
            <th><b>Hora Salida</b></th>
            <th><b>Hora Entrada</b></th>
            <th><b>Motivo</b></th>
        </tr>
        </thead>
        <tbody>
    @foreach($dato as $data)
            <tr>
                <td>{{ date('d-m-Y', strtotime($data->papeletasalida->fecha)) }}</td>
                <br>
                <td>{{$data->papeletasalida->user->fullname}}</td>
                <td>{{$data->papeletasalida->horasalida}}</td>
                <td>{{$data->papeletasalida->horaretorno}}</td>
                <td>{{$data->papeletasalida->motivopapeletasalida->nombre}}</td>

            </tr>

            <tr>
                <thead>

                    </thead>
                    <td><b>Cliente</b></td>

                <td>{{$data->cliente->razonsocial}}</td>
                <td><b>Contacto</b></td>
                <td>{{$data->contacto}}</td>
                <td><b>Fundamento</b></td>
                <td>{{$data->papeletasalida->fundamento}}</td>



            </tr>

            @endforeach
        </tbody>
    </table>

</body>
</html>
