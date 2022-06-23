<!DOCTYPE html>
<html>
<head>
    <title>Laravel 9 Generate PDF Example - ItSolutionStuff.com</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <h1>{{ $title }}</h1>
    <p>{{ $date }}</p>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
    tempor incididunt ut labore et dolore magna aliqua.</p>

    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Documento</th>
            <th>Direccion</th>
            <th>Telefono</th>
            <th>Contrato</th>
            <th>Sueldo</th>
            <th>Duracion</th>
        </tr>
        <tr>

            <td>{{ $worker->id }}</td>
            <td>{{ $worker->nombre }}</td>
            <td>{{ $worker->documento }}</td>
            <td>{{ $worker->direccion }}</td>
            <td>{{ $worker->telefono }}</td>
            <td>{{ $worker->pay->contract->tipo }}</td>
            <td>{{ $worker->pay->sueldo }}</td>
            <td>{{ $worker->pay->duracion }}</td>
        </tr>
    </table>

</body>
</html>
