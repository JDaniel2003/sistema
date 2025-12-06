<?php

namespace App\Http\Controllers;

use App\Models\Ciclo;
use App\Models\PeriodoEscolar;
use App\Models\TipoPeriodo;
use Illuminate\Http\Request;

class PeriodoEscolarController extends Controller
{
    public function index(Request $request)
    {
        $query = PeriodoEscolar::with('tipoPeriodo');


        
        // Filtro por nombre
        if ($request->filled('nombre')) {
            $query->where('nombre', 'like', '%' . $request->nombre . '%');
        }

        // Filtro por estado
        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        // Filtro por fechas
        // ---- Filtro por fecha exacta ----
if ($request->filled('fecha_inicio')) {
    $query->whereDate('fecha_inicio', $request->fecha_inicio);
}

if ($request->filled('fecha_fin')) {
    $query->whereDate('fecha_fin', $request->fecha_fin);
}


        // Filtro por tipo de período
        if ($request->filled('id_tipo_periodo')) {
            $query->where('id_tipo_periodo', $request->id_tipo_periodo);
        }

        // Orden fijo (por fecha_inicio orden)
        //$periodos = $query->orderBy('fecha_inicio', 'orden')->paginate(10);
        $mostrar = $request->get('mostrar', 10); // por defecto 10

        if ($mostrar === "todo") {
            $periodos = $query->orderBy('id_periodo_escolar', 'desc')->get();
        } else {
            $periodos = $query->orderBy('id_periodo_escolar', 'desc')->paginate((int)$mostrar);
        }

        
        // Para llenar el select de tipos
        $tipos = TipoPeriodo::all();
        $ciclos = Ciclo::all();
        $cicloActual = Ciclo::where('estado', 'Activo')->first();
        return view('layouts.periodos', compact('periodos', 'tipos','ciclos','cicloActual'));
    }

    ///////////////////////////////////////////////////////////////////////////////
    public function create()
    {
        $tipos = TipoPeriodo::all();
        $ciclos = Ciclo::all();
        return view('periodos.create', compact('tipos','ciclos'));
    }

    public function store(Request $request)
{
    // 1️⃣ Validación básica
    $request->validate([
    'nombre' => [
        'required',
        'string',
        'max:255',
        'unique:periodos_escolares,nombre',
        'regex:/^[A-ZÁÉÍÓÚÑ]+-[A-ZÁÉÍÓÚÑ]+ \d{4}$/'
    ],
    'id_tipo_periodo' => 'required|exists:tipos_periodos,id_tipo_periodo',
    'fecha_inicio' => 'required|date',
    'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
    'estado' => 'required|in:Abierto,Cerrado',
], [
    'nombre.required' => 'El nombre del período es obligatorio.',
    'nombre.unique' => 'Ya existe un período escolar con este nombre.',
    'nombre.regex' => 'El nombre debe tener el formato: EJEMPLO-EJEMPLO 2024 (mayúsculas y año).',
    
    'id_tipo_periodo.required' => 'Debes seleccionar un tipo de período.',
    'id_tipo_periodo.exists' => 'El tipo de período seleccionado no es válido.',
    
    'fecha_inicio.required' => 'La fecha de inicio es obligatoria.',
    'fecha_inicio.date' => 'La fecha de inicio debe ser una fecha válida.',
    
    'fecha_fin.required' => 'La fecha de fin es obligatoria.',
    'fecha_fin.date' => 'La fecha de fin debe ser una fecha válida.',
    'fecha_fin.after_or_equal' => 'La fecha de fin debe ser igual o mayor que la fecha de inicio.',

    'estado.required' => 'Debes seleccionar un estado.',
    'estado.in' => 'El estado solo puede ser Abierto o Cerrado.',
]);


   // 2️⃣ Obtener duración del tipo de período desde la BD
$tipo = TipoPeriodo::findOrFail($request->id_tipo_periodo);
$duracionMesesBD = (int)$tipo->duracion; // ej: 6, 4, 3, etc.

// ⭐ Si es semestre (6 meses en BD), permitir 5 o 6
if ($duracionMesesBD === 6) {
    $duracionesValidas = [5, 6];
} else {
    // Para los demás, validar exactamente lo que dice la BD
    $duracionesValidas = [$duracionMesesBD];
}

// 3️⃣ Calcular fechas usando Carbon
$fechaInicio = \Carbon\Carbon::parse($request->fecha_inicio);
$fechaFin = \Carbon\Carbon::parse($request->fecha_fin);

// 📅 Validar que la fecha fin sea posterior a la fecha inicio
if ($fechaFin->lte($fechaInicio)) {
    return back()
        ->withErrors([
            'fecha_fin' => 'La fecha de fin debe ser posterior a la fecha de inicio.'
        ])
        ->withInput();
}

// 📊 Calcular diferencia en meses considerando solo año y mes (ignorando días)
$mesInicio = $fechaInicio->month;
$anioInicio = $fechaInicio->year;
$mesFin = $fechaFin->month;
$anioFin = $fechaFin->year;

// Fórmula: (año_fin - año_inicio) * 12 + (mes_fin - mes_inicio) + 1
$mesesReales = (($anioFin - $anioInicio) * 12) + ($mesFin - $mesInicio) + 1;

// 🔍 Validar que la duración en meses coincida con las permitidas
if (!in_array($mesesReales, $duracionesValidas)) {

    // Construir mensaje adecuado
    $textoDuraciones = implode(" o ", $duracionesValidas);

    return back()
        ->withErrors([
            'fecha_fin' => sprintf(
                'La duración del período debe ser de %s meses, pero actualmente estás ingresando %d meses.',
                $textoDuraciones,
                $mesesReales
            )
        ])
        ->withInput();
}



    // 4️⃣ Crear período
    PeriodoEscolar::create([
        'nombre' => $request->nombre,
        'id_tipo_periodo' => $request->id_tipo_periodo,
        'fecha_inicio' => $request->fecha_inicio,
        'fecha_fin' => $request->fecha_fin,
        'estado' => $request->estado,
        'id_ciclo' => $request->id_ciclo,
    ]);

    return redirect()->route('periodos.index')
        ->with('success', 'Período escolar creado correctamente.');
}

// 🎯 MÉTODO ADICIONAL: Calcular automáticamente la fecha fin
public function calcularFechaFin(Request $request)
{
    $request->validate([
        'fecha_inicio' => 'required|date',
        'id_tipo_periodo' => 'required|exists:tipos_periodos,id_tipo_periodo'
    ]);

    $tipo = TipoPeriodo::findOrFail($request->id_tipo_periodo);
    $duracionMeses = (int)$tipo->duracion;
    
    $fechaInicio = \Carbon\Carbon::parse($request->fecha_inicio);
    
    // Sumar los meses de duración y restar 1 para quedarnos en el mismo mes
    // Ejemplo: 15/01/2025 + 6 meses - 1 mes = mes de Junio
    $fechaFin = $fechaInicio->copy()->addMonths($duracionMeses - 1)->endOfMonth();

    return response()->json([
        'fecha_fin' => $fechaFin->format('Y-m-d'),
        'fecha_fin_formateada' => $fechaFin->format('d/m/Y'),
        'duracion_meses' => $duracionMeses,
        'mes_fin' => $fechaFin->translatedFormat('F Y')
    ]);
}

    public function edit($id)
    {
        $tipos = TipoPeriodo::all();
        $periodo = PeriodoEscolar::findOrFail($id);
        return view('periodos.edit', compact('periodo', 'tipos'));
    }

    public function update(Request $request, $id)
{
    // 1️⃣ Validación básica
    $request->validate([
    'nombre' => [
        'required',
        'string',
        'max:255',
        'unique:periodos_escolares,nombre,' . $id . ',id_periodo_escolar',
        'regex:/^[A-ZÁÉÍÓÚÑ]+-[A-ZÁÉÍÓÚÑ]+ \d{4}$/'
    ],
    'id_tipo_periodo' => 'required|exists:tipos_periodos,id_tipo_periodo',
    'fecha_inicio' => 'required|date',
    'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
    'estado' => 'required|in:Abierto,Cerrado',
], [
    'nombre.required' => 'El nombre del período es obligatorio.',
    'nombre.unique' => 'Ya existe otro período con este nombre.',
    'nombre.regex' => 'El nombre debe tener el formato: EJEMPLO-EJEMPLO 2024.',
    
    'id_tipo_periodo.required' => 'Debes seleccionar un tipo de período.',
    'id_tipo_periodo.exists' => 'El tipo de período seleccionado no es válido.',
    
    'fecha_inicio.required' => 'La fecha de inicio es obligatoria.',
    'fecha_inicio.date' => 'La fecha de inicio debe ser una fecha válida.',
    
    'fecha_fin.required' => 'La fecha de fin es obligatoria.',
    'fecha_fin.date' => 'La fecha de fin debe ser una fecha válida.',
    'fecha_fin.after_or_equal' => 'La fecha de fin debe ser igual o mayor que la fecha de inicio.',

    'estado.required' => 'Debes seleccionar un estado.',
    'estado.in' => 'El estado solo puede estar en Abierto o Cerrado.',
]);


   // 2️⃣ Obtener duración del tipo de período desde la BD
$tipo = TipoPeriodo::findOrFail($request->id_tipo_periodo);
$duracionMesesBD = (int)$tipo->duracion; // ej: 6, 4, 3, etc.

// ⭐ Si es semestre (6 meses en BD), permitir 5 o 6
if ($duracionMesesBD === 6) {
    $duracionesValidas = [5, 6];
} else {
    // Para los demás, validar exactamente lo que dice la BD
    $duracionesValidas = [$duracionMesesBD];
}

// 3️⃣ Calcular fechas usando Carbon
$fechaInicio = \Carbon\Carbon::parse($request->fecha_inicio);
$fechaFin = \Carbon\Carbon::parse($request->fecha_fin);

// 📅 Validar que la fecha fin sea posterior a la fecha inicio
if ($fechaFin->lte($fechaInicio)) {
    return back()
        ->withErrors([
            'fecha_fin' => 'La fecha de fin debe ser posterior a la fecha de inicio.'
        ])
        ->withInput();
}

// 📊 Calcular diferencia en meses considerando solo año y mes (ignorando días)
$mesInicio = $fechaInicio->month;
$anioInicio = $fechaInicio->year;
$mesFin = $fechaFin->month;
$anioFin = $fechaFin->year;

// Fórmula: (año_fin - año_inicio) * 12 + (mes_fin - mes_inicio) + 1
$mesesReales = (($anioFin - $anioInicio) * 12) + ($mesFin - $mesInicio) + 1;

// 🔍 Validar que la duración en meses coincida con las permitidas
if (!in_array($mesesReales, $duracionesValidas)) {

    // Construir mensaje adecuado
    $textoDuraciones = implode(" o ", $duracionesValidas);

    return back()
        ->withErrors([
            'fecha_fin' => sprintf(
                'La duración del período debe ser de %s meses, pero actualmente estás ingresando %d meses.',
                $textoDuraciones,
                $mesesReales
            )
        ])
        ->withInput();
}


    // 4️⃣ Actualizar el período
    $periodo = PeriodoEscolar::findOrFail($id);
    $periodo->update([
        'nombre' => $request->nombre,
        'id_tipo_periodo' => $request->id_tipo_periodo,
        'fecha_inicio' => $request->fecha_inicio,
        'fecha_fin' => $request->fecha_fin,
        'estado' => $request->estado,
        'id_ciclo' => $request->id_ciclo,
    ]);

    return redirect()->route('periodos.index')
        ->with('success', 'Período escolar actualizado correctamente.');
}

    public function destroy($id)
    {
        $periodo = PeriodoEscolar::findOrFail($id);
        $periodo->delete();

        return redirect()->route('periodos.index')
            ->with('success', 'Período escolar eliminado correctamente.');
    }
    public function cambiarEstado(Request $request, $id)
{
    try {
        $periodo = PeriodoEscolar::findOrFail($id);
        
        // Validar que no se pueda reabrir un período cerrado
        if ($periodo->estado == 'Cerrado' && $request->estado == 'Abierto') {
            return response()->json([
                'success' => false,
                'message' => 'No se puede reabrir un período que ya está cerrado.'
            ], 400);
        }
        
        $periodo->estado = $request->estado;
        $periodo->save();
        
        return response()->json([
            'success' => true,
            'message' => 'Estado actualizado correctamente.'
        ]);
        
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Error al cambiar el estado: ' . $e->getMessage()
        ], 500);
    }
}
}
