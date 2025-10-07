<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CuadreController;



Route::get('/', [CuadreController::class, 'index']);
Route::post('/guardar', [CuadreController::class, 'store'])->name('guardar.cuadre');
Route::get('/reporte/{id}', [CuadreController::class, 'reporte'])->name('reporte.cuadre');

Route::get('/reporte/{id}/domicilios', [CuadreController::class, 'reporteDomicilios'])->name('reporte.domicilios');
Route::get('/reporte/{id}/propina', [CuadreController::class, 'reportePropina'])->name('reporte.propina');
Route::get('/reporte/{id}/documentos', [CuadreController::class, 'reporteDocumentos'])->name('reporte.documentos');
Route::get('/cuadre/{id}/reporte-completo', [CuadreController::class, 'reporteCompleto'])->name('reporte.completo');
Route::delete('/cuadre/{id}', [CuadreController::class, 'destroy'])->name('cuadre.destroy');

// Route::get('/', function () {
//     return view('welcome');
// });


