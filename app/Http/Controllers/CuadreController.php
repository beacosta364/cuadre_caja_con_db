<?php

namespace App\Http\Controllers;

use App\Models\Cuadre;
use Illuminate\Http\Request;


class CuadreController extends Controller
{
    // public function index()
    // {
    //     return view('cuadre.index');
    // }
    public function index(Request $request)
    {
        $query = Cuadre::query();

        // Filtro por rango de fechas si se envían
        if ($request->filled('fecha_inicio') && $request->filled('fecha_fin')) {
            $query->whereBetween('fecha', [$request->fecha_inicio, $request->fecha_fin]);
        } else {
            // Por defecto: mostrar los del último mes
            $query->where('fecha', '>=', now()->subMonth());
        }

        $cuadres = $query->orderBy('fecha', 'desc')->get();

        return view('cuadre.index', compact('cuadres'));
    }



    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $cuadre = Cuadre::create($request->all());
        return redirect()->route('reporte.cuadre', $cuadre->id);
    }

    public function show(Cuadre $cuadre)
    {
        //
    }

    public function edit(Cuadre $cuadre)
    {
        //
    }

    public function update(Request $request, Cuadre $cuadre)
    {
        //
    }

    public function destroy(Request $request, $id)
    {
        // Claves permitidas (para prueba).
        $allowedPasswords = [
            '437278',
            '831024',
            '902713',
            '174859',
            '660022',
        ];

        $pwd = $request->input('delete_password');

        if (!in_array($pwd, $allowedPasswords, true)) {
            return redirect()->back()->with('error', 'Contraseña incorrecta. No se eliminó el registro.');
        }

        $cuadre = Cuadre::find($id);

        if (!$cuadre) {
            return redirect()->back()->with('error', 'Registro no encontrado.');
        }

        try {
            $cuadre->delete();
            return redirect()->back()->with('success', 'Cuadre eliminado correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al eliminar: ' . $e->getMessage());
        }
    }

    public function reporte($id)
    {
        $cuadre = Cuadre::findOrFail($id);
        return view('cuadre.reporte', compact('cuadre'));
    }

    public function reporteDomicilios($id)
    {
        $cuadre = Cuadre::findOrFail($id);
        return view('cuadre.reporte_domicilios', compact('cuadre'));
    }

    public function reportePropina($id)
    {
        $cuadre = Cuadre::findOrFail($id);
        return view('cuadre.reporte_propina', compact('cuadre'));
    }

    public function reporteDocumentos($id)
    {
        $cuadre = Cuadre::findOrFail($id);
        return view('cuadre.reporte_documentos', compact('cuadre'));
    }

    // public function reporteCompleto($id)
    // {
    //     $cuadre = Cuadre::findOrFail($id);
    //     return view('cuadre.reporte_completo', compact('cuadre'));
    // }
    public function reporteCompleto(Request $request, $id)
    {
        // Claves válidas
        $allowedPasswords = [
            '437278',
            '831024',
            '902713',
            '174859',
            '660022',
        ];

        $password = $request->input('password');

        // Si no hay contraseña enviada, mostramos la vista para pedirla
        if (!$password) {
            return view('cuadre.verificar_password', compact('id'));
        }

        // Si la contraseña es incorrecta
        if (!in_array($password, $allowedPasswords, true)) {
            return redirect()->back()->with('error', 'Contraseña incorrecta.');
        }

        // Si la contraseña es correcta, mostramos el reporte
        $cuadre = Cuadre::findOrFail($id);
        return view('cuadre.reporte_completo', compact('cuadre'));
    }


}

