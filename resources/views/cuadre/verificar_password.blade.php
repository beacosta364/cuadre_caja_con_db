<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Verificar Contraseña - Reporte</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5 p-4 bg-white shadow rounded" style="max-width:400px;">
    <h4 class="text-center mb-3">🔐 Acceso al Reporte</h4>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form method="GET" action="{{ route('reporte.completo', $id) }}">
        <div class="mb-3">
            <label class="form-label">Ingrese la contraseña:</label>
            <input type="password" name="password" class="form-control" required autofocus>
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-primary">Ver Reporte</button>
        </div>
    </form>
</div>

</body>
</html>
