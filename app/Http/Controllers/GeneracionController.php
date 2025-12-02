<?php

namespace App\Http\Controllers;

use App\Models\Generacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GeneracionController extends Controller
{
    public function index(Request $request)
    {
        $query = Generacion::query();

        // Filtros
        if ($request->filled('nombre')) {
            $query->where('nombre', 'LIKE', "%{$request->nombre}%");
        }
        if ($request->filled('anio_inicio')) {
            $query->where('anio_inicio', $request->anio_inicio);
        }
        if ($request->filled('anio_fin')) {
            $query->where('anio_fin', $request->anio_fin);
        }

        // Paginación o mostrar todo
        if ($request->mostrar === 'todo') {
            $generaciones = $query->get();
        } else {
            $perPage = in_array($request->mostrar, [10, 15, 25, 50]) ? (int) $request->mostrar : 10;
            $generaciones = $query->paginate($perPage);
        }

        return view('generaciones.index', compact('generaciones'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre'      => 'nullable|string|max:20',
            'anio_inicio' => 'nullable|date',
            'anio_fin'    => 'nullable|date|after_or_equal:anio_inicio',
        ], [
            'anio_fin.after_or_equal' => 'La fecha de fin debe ser igual o posterior a la de inicio.',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput(['is_create' => 1]);
        }

        Generacion::create($request->only(['nombre', 'anio_inicio', 'anio_fin']));

        return redirect()
            ->route('generaciones.index')
            ->with('success', 'Generación creada exitosamente.');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nombre'      => 'nullable|string|max:20',
            'anio_inicio' => 'nullable|date',
            'anio_fin'    => 'nullable|date|after_or_equal:anio_inicio',
        ], [
            'anio_fin.after_or_equal' => 'La fecha de fin debe ser igual o posterior a la de inicio.',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput(['generacion_id' => $id]);
        }

        $generacion = Generacion::findOrFail($id);
        $generacion->update($request->only(['nombre', 'anio_inicio', 'anio_fin']));

        return redirect()
            ->route('generaciones.index')
            ->with('success', 'Generación actualizada exitosamente.');
    }

    public function destroy($id)
    {
        $generacion = Generacion::findOrFail($id);
        $generacion->delete();

        return redirect()
            ->route('generaciones.index')
            ->with('success', 'Generación eliminada exitosamente.');
    }
}