<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte Cuadre Diario</title>
    <style>
        body {
            font-family: monospace;
            background: #f9f9f9;
            padding: 20px;
        }
        .ticket {
            background: #fff;
            border: 1px solid #ccc;
            width: 280px;
            margin: auto;
            padding: 15px;
        }
        .titulo {
            text-align: center;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .linea {
            display: flex;
            justify-content: space-between;
            font-size: 14px;
        }
        hr {
            border: none;
            border-top: 1px dashed #000;
            margin: 8px 0;
        }
    </style>
</head>
<body>

@php
$sub1 = $cuadre->total_venta - $cuadre->propina - $cuadre->domicilio;
$reds = $cuadre->red1 + $cuadre->red2 + $cuadre->red3 + $cuadre->red4 + $cuadre->red5 + $cuadre->red6;
$sub2 = $sub1 - $reds;
$sub3 = $sub2 - $cuadre->transferencias;
$sub4 = $sub3 - $cuadre->cuenta_cobrar;
$sub5 = $sub4 - $cuadre->gastos;
$sub6 = $sub5 - $cuadre->efectivo_oficina;
$verif = $sub6 + $cuadre->propina + $cuadre->domicilio;
@endphp

<div class="ticket">
    <div class="titulo">CUADRE DE CAJA DIARIO</div>
    <div class="linea"><span>Fecha:</span><span>{{ $cuadre->fecha }}</span></div>
    <hr>

    <div class="linea"><span>Total Venta:</span><span>${{ number_format($cuadre->total_venta, 0, ',', '.') }}</span></div>
    <div class="linea"><span>Propina:</span><span>${{ number_format($cuadre->propina, 0, ',', '.') }}</span></div>
    <div class="linea"><span>Domicilio:</span><span>${{ number_format($cuadre->domicilio, 0, ',', '.') }}</span></div>
    <div class="linea"><span>Subtotal 1:</span><span>${{ number_format($sub1, 0, ',', '.') }}</span></div>
    <hr>

    @for ($i = 1; $i <= 6; $i++)
        @php $red = 'red'.$i; @endphp
        <div class="linea"><span>Red {{ $i }}:</span><span>${{ number_format($cuadre->$red ?? 0, 0, ',', '.') }}</span></div>
    @endfor
    <div class="linea"><span>Subtotal 2:</span><span>${{ number_format($sub2, 0, ',', '.') }}</span></div>
    <hr>

    <div class="linea"><span>Transferencias:</span><span>${{ number_format($cuadre->transferencias, 0, ',', '.') }}</span></div>
    <div class="linea"><span>Subtotal 3:</span><span>${{ number_format($sub3, 0, ',', '.') }}</span></div>
    <hr>

    <div class="linea"><span>Cuentas x Cobrar:</span><span>${{ number_format($cuadre->cuenta_cobrar, 0, ',', '.') }}</span></div>
    <div class="linea"><span>Subtotal 4:</span><span>${{ number_format($sub4, 0, ',', '.') }}</span></div>
    <hr>

    <div class="linea"><span>Gastos:</span><span>${{ number_format($cuadre->gastos, 0, ',', '.') }}</span></div>
    <div class="linea"><span>Subtotal 5:</span><span>${{ number_format($sub5, 0, ',', '.') }}</span></div>
    <hr>

    <div class="linea"><span>Efectivo Oficina:</span><span>${{ number_format($cuadre->efectivo_oficina, 0, ',', '.') }}</span></div>
    <div class="linea"><span>Subtotal 6:</span><span>${{ number_format($sub6, 0, ',', '.') }}</span></div>
    <hr>

    <div class="linea"><span>Propina:</span><span>${{ number_format($cuadre->propina, 0, ',', '.') }}</span></div>
    <div class="linea"><span>Domicilio:</span><span>${{ number_format($cuadre->domicilio, 0, ',', '.') }}</span></div>
    <div class="linea"><strong>Efectivo en caja:</strong><strong>${{ number_format($verif, 0, ',', '.') }}</strong></div>

    <hr>
    <div style="text-align:center; margin-top:10px;">
        <a href="{{ route('reporte.domicilios', $cuadre->id) }}" target="_blank">🛵 Domicilios</a> |
        <a href="{{ route('reporte.propina', $cuadre->id) }}" target="_blank">💵 Propina</a> |
        <a href="{{ route('reporte.documentos', $cuadre->id) }}" target="_blank">📑 Documentos</a>
        <a href="{{ route('reporte.completo', $cuadre->id) }}" target="_blank" class="btn btn-primary">Ver Reporte Completo</a>
    </div>

</div>

</body>
</html>
