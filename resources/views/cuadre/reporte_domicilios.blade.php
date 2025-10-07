<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte Domicilios</title>
    <style>
        body { font-family: monospace; background: #f9f9f9; padding: 20px; }
        .ticket {
            background: #fff;
            border: 1px solid #ccc;
            width: 280px;
            margin: auto;
            padding: 15px;
        }
        .titulo { text-align: center; font-weight: bold; margin-bottom: 10px; }
        .linea { text-align: center; font-size: 14px; }
    </style>
</head>
<body>
<div class="ticket">
    <div class="titulo">{{ $cuadre->fecha }}</div>
    <div class="titulo">DOMICILIOS</div>
    <div class="linea">${{ number_format($cuadre->domicilio, 0, ',', '.') }}</div>
</div>
</body>
</html>
