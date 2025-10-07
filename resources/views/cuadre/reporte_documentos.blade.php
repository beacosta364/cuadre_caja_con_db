<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte Documentos</title>
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
        .linea { display: flex; justify-content: space-between; font-size: 13px; }
        hr { border: none; border-top: 1px dashed #000; margin: 6px 0; }
    </style>
</head>
<body>
@php
$subtotalRed = $cuadre->red1 + $cuadre->red2 + $cuadre->red3 + $cuadre->red4 + $cuadre->red5 + $cuadre->red6;
$subtotalDocs = $subtotalRed + $cuadre->transferencias;
$totalDocs = $subtotalDocs + $cuadre->cuenta_cobrar;
@endphp

<div class="ticket">
    <div class="titulo">{{ $cuadre->fecha }}</div>
    <div class="titulo">DOCUMENTOS</div>
    <hr>
    @for ($i = 1; $i <= 6; $i++)
        @php $red = 'red'.$i; @endphp
        <div class="linea"><span>RED {{ $i }}:</span><span>${{ number_format($cuadre->$red ?? 0, 0, ',', '.') }}</span></div>
    @endfor
    <div class="linea"><strong>SUBTOTAL RED:</strong><strong>${{ number_format($subtotalRed, 0, ',', '.') }}</strong></div>
    <hr>
    <div class="linea"><span>TRANSFERENCIAS:</span><span>${{ number_format($cuadre->transferencias, 0, ',', '.') }}</span></div>
    <div class="linea"><strong>SUBTOTAL DOCS:</strong><strong>${{ number_format($subtotalDocs, 0, ',', '.') }}</strong></div>
    <hr>
    <div class="linea"><span>CUENTA X COBRAR:</span><span>${{ number_format($cuadre->cuenta_cobrar, 0, ',', '.') }}</span></div>
    <div class="linea"><strong>TOTAL DOCUMENTOS:</strong><strong>${{ number_format($totalDocs, 0, ',', '.') }}</strong></div>
</div>

</body>
</html>
