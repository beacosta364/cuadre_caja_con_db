<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Cuadre de Caja - Diario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-4 p-4 bg-white shadow rounded">
    <h2 class="text-center mb-4">📋 Cuadre de Caja Diario</h2>

    <form action="{{ route('guardar.cuadre') }}" method="POST">
        @csrf
        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label">Fecha</label>
                <input type="date" name="fecha" class="form-control" required>
            </div>

            <div class="col-md-4">
                <label class="form-label">Total de Venta</label>
                <input type="number" step="0.01" name="total_venta" class="form-control">
            </div>

            <div class="col-md-4">
                <label class="form-label">Propina</label>
                <input type="number" step="0.01" name="propina" class="form-control">
            </div>

            <div class="col-md-4">
                <label class="form-label">Domicilio</label>
                <input type="number" step="0.01" name="domicilio" class="form-control">
            </div>

            @for ($i = 1; $i <= 6; $i++)
                <div class="col-md-4">
                    <label class="form-label">Red {{ $i }}</label>
                    <input type="number" step="0.01" name="red{{ $i }}" class="form-control">
                </div>
            @endfor

            <div class="col-md-4">
                <label class="form-label">Transferencias</label>
                <input type="number" step="0.01" name="transferencias" class="form-control">
            </div>

            <div class="col-md-4">
                <label class="form-label">Cuenta por Cobrar</label>
                <input type="number" step="0.01" name="cuenta_cobrar" class="form-control">
            </div>

            <div class="col-md-4">
                <label class="form-label">Gastos</label>
                <input type="number" step="0.01" name="gastos" class="form-control">
            </div>

            <div class="col-md-4">
                <label class="form-label">Efectivo Oficina</label>
                <input type="number" step="0.01" name="efectivo_oficina" class="form-control">
            </div>
        </div>

        <div class="text-center mt-4">
            <button type="submit" class="btn btn-primary px-4 py-2">Guardar y Generar Reporte</button>
        </div>
    </form>
</div>

</body>
</html>
