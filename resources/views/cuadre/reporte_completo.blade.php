
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte Completo del Cuadre</title>
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

    {{-- Reporte General --}}
    <section>
        <!-- <h2>GENERAL</h2> -->
        @include('cuadre.reporte', ['cuadre' => $cuadre])
    </section>
    <br>
    <br>
    {{-- Reporte de Documentos --}}
    <section>
        <!-- <h2>DOCUMENTOS</h2> -->
        @include('cuadre.reporte_documentos', ['cuadre' => $cuadre])
    </section>
    <br>
    <br>
    {{-- Reporte de Domicilios --}}
    <section>
        <!-- <h2>DOMICILIOS</h2> -->
        @include('cuadre.reporte_domicilios', ['cuadre' => $cuadre])
    </section>
    <br>
    <br>
    {{-- Reporte de Propinas --}}
    <section>
        <!-- <h2>PROPINAS</h2> -->
        @include('cuadre.reporte_propina', ['cuadre' => $cuadre])
    </section>
</body>
</html>
