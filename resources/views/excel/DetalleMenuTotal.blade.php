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
            <th>Personal</th>
            <th>Cantidad</th>
        </tr>
        </thead>
        <tbody>
    @foreach($listeMenuDetalleTotalFecha as $data)

            <tr>
                <td>{{ date('d-m-Y', strtotime($data->fecha)) }}</td>
                <td>{{$data->personal}} </td>
                <td>{{strtoupper($data->cantidad)}} </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
