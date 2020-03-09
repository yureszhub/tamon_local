<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista Cotizacion</title>
</head>
<body>
    <h1 style="text-align: center; background-color: #852473; color: #fff;">COTIZACION DESDE TIENDA TAMON</h1>
    <div>
        <strong>Nombre del Solicitante: </strong><span>{{ $data_cotizacion['nombre_solicitante'] }}</span><br>
        <strong>Correo del solicitante: </strong><span>{{ $data_cotizacion['correo_solicitante'] }}</span><br>
        <strong>Teléfono del solicitante: </strong><span>{{ $data_cotizacion['tel_solicitante'] }}</span><br>
    </div>
    <div>
        {!! $data_cotizacion['lista'] !!}
    </div>
</body>
</html>