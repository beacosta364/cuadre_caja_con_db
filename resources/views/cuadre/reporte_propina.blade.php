<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte Propina</title>
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
        .linea { font-size: 14px; text-align: center; }
    </style>
</head>
<body>
<div class="ticket">
    <div class="titulo">{{ $cuadre->fecha }}</div>
    <div class="titulo">PROPINA</div>
    <div class="linea">PROPINA: ${{ number_format($cuadre->propina, 0, ',', '.') }}</div>
    <br>
    <div class="linea">REPIQUE: _____________________</div>
</div>
</body>
</html>
