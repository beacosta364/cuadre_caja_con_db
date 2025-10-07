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

    {{-- Formulario de creación --}}
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
{{-- Mensajes flash --}}
<div class="container mt-3">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
</div>

{{-- Sección de reportes anteriores --}}
<div class="container mt-5 p-4 bg-white shadow rounded">
    <h4 class="mb-3 text-center">📆 Cuadres Registrados</h4>

    {{-- Buscador por rango de fechas --}}
    <form method="GET" class="row g-3 mb-4">
        <div class="col-md-4">
            <label class="form-label">Desde</label>
            <input type="date" name="fecha_inicio" value="{{ request('fecha_inicio') }}" class="form-control">
        </div>

        <div class="col-md-4">
            <label class="form-label">Hasta</label>
            <input type="date" name="fecha_fin" value="{{ request('fecha_fin') }}" class="form-control">
        </div>

        <div class="col-md-4 d-flex align-items-end">
            <button class="btn btn-success w-100" type="submit">Buscar</button>
        </div>
    </form>

    {{-- Tabla de resultados --}}
    <table class="table table-bordered table-hover text-center align-middle">
        <thead class="table-primary">
            <tr>
                <th>ID</th>
                <th>Fecha</th>
                <th>Total Venta</th>
                <th>Propina</th>
                <th>Domicilio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($cuadres as $cuadre)
                <tr>
                    <td>{{ $cuadre->id }}</td>
                    <td>{{ $cuadre->fecha }}</td>
                    <td>${{ number_format($cuadre->total_venta, 2) }}</td>
                    <td>${{ number_format($cuadre->propina, 2) }}</td>
                    <td>${{ number_format($cuadre->domicilio, 2) }}</td>
                    <td>
                        <a href="{{ route('reporte.completo', $cuadre->id) }}" target="_blank" class="btn btn-sm btn-primary">
                            Ver Reporte
                        </a>

                        {{-- Formulario DELETE (se completará la contraseña desde JS prompt) --}}
                        <form id="delete-form-{{ $cuadre->id }}" action="{{ route('cuadre.destroy', $cuadre->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="delete_password" id="delete_password_{{ $cuadre->id }}" value="">
                            <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $cuadre->id }});">
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">No se encontraron registros.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- Script para pedir contraseña y enviar formulario --}}
<script>
function confirmDelete(id) {
    // Prompt para la contraseña
    const pwd = prompt('Ingrese la contraseña para eliminar este cuadre:');

    // Si se presionó Cancelar o se dejó vacío, no eliminar
    if (pwd === null) return; // usuario canceló
    const trimmed = pwd.trim();
    if (trimmed.length === 0) {
        alert('Contraseña vacía. Operación cancelada.');
        return;
    }

    // Colocar la contraseña en el input oculto y enviar el form
    document.getElementById('delete_password_' + id).value = trimmed;
    document.getElementById('delete-form-' + id).submit();
}
</script>
