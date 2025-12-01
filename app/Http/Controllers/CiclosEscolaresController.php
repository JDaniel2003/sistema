<?php

namespace App\Http\Controllers;

use App\Models\Ciclo;
use App\Models\CicloEscolar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CiclosEscolaresController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Ciclo::query();

        
        $ciclos = $query->orderByDesc('id_ciclo')->paginate(10);
         $mostrar = $request->get('mostrar', 10);

    if ($mostrar === 'todo') {
        $ciclos = $query->orderByDesc('id_ciclo')->get();
    } else {
        $perPage = is_numeric($mostrar) ? (int) $mostrar : 10;
        $ciclos = $query->orderByDesc('id_ciclo')->paginate($perPage)->appends($request->all());
    }


        return view('ciclos.index', compact('ciclos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:50|unique:ciclos_escolares,nombre',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after:fecha_inicio',
            'estado' => 'required|in:Activo,Inactivo'
        ], [
            'nombre.required' => 'El nombre del ciclo es obligatorio',
            'nombre.unique' => 'Este ciclo escolar ya existe',
            'fecha_inicio.required' => 'La fecha de inicio es obligatoria',
            'fecha_fin.required' => 'La fecha de fin es obligatoria',
            'fecha_fin.after' => 'La fecha de fin debe ser posterior a la fecha de inicio',
            'estado.required' => 'El estado es obligatorio'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Error al crear el ciclo escolar');
        }

        Ciclo::create($request->all());

        return redirect()->route('ciclos.index')
            ->with('success', 'Ciclo escolar creado exitosamente');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $ciclo = Ciclo::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:50|unique:ciclos_escolares,nombre,' . $id . ',id_ciclo',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after:fecha_inicio',
            'estado' => 'required|in:Activo,Inactivo'
        ], [
            'nombre.required' => 'El nombre del ciclo es obligatorio',
            'nombre.unique' => 'Este ciclo escolar ya existe',
            'fecha_inicio.required' => 'La fecha de inicio es obligatoria',
            'fecha_fin.required' => 'La fecha de fin es obligatoria',
            'fecha_fin.after' => 'La fecha de fin debe ser posterior a la fecha de inicio',
            'estado.required' => 'El estado es obligatorio'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Error al actualizar el ciclo escolar');
        }

        $ciclo->update($request->all());

        return redirect()->route('ciclos.index')
            ->with('success', 'Ciclo escolar actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $ciclo = Ciclo::findOrFail($id);
            $ciclo->delete();

            return redirect()->route('ciclos.index')
                ->with('success', 'Ciclo escolar eliminado exitosamente');
        } catch (\Exception $e) {
            return redirect()->route('ciclos.index')
                ->with('error', 'No se puede eliminar el ciclo escolar porque tiene registros asociados');
        }
    }
}