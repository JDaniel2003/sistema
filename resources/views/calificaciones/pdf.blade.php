<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Calificaciones</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 9px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 4px; text-align: center; }
        th { background-color: #f2f2f2; }
        .text-left { text-align: left !important; }
        .text-center { text-align: center !important; }
        .bg-info { background-color: #17a2b8 !important; color: white; }
        .bg-warning { background-color: #ffc107 !important; color: black; }
    </style>
</head>
<body>

<div class="text-center mb-3">
    <h2>Acta de Calificaciones</h2>
    <p><strong>Materia:</strong> {{ $materiaNombre }}</p>
    <p><strong>Grupo:</strong> {{ $grupoNombre }}</p>
    <p><strong>Período:</strong> {{ $periodoNombre }}</p>
    {{--<p><strong>Total alumnos:</strong> <strong>{{ $totalAlumnos }}</strong></p>--}}
</div>

<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Matrícula</th>
            <th>Alumno</th>
            @foreach($unidades as $unidad)
                <th>{{ $unidad['nombre'] }}</th>
            @endforeach
            <th> Promedio</th>
            <th> Calificación Especial</th>
        </tr>
    </thead>
    <tbody>
        @foreach($alumnos as $index => $alumno)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $alumno['matricula'] }}</td>
            <td class="text-left">{{ $alumno['nombre'] }}</td>
            @foreach($unidades as $unidad)
                @php
                    $key = $alumno['id_alumno'] . '_' . $unidad['id_unidad'];
                    $califData = $alumno['calificaciones'][$key] ?? null;
                @endphp
                <td>
                    @if($califData && $califData['calificacion'] !== null)
                        {{ number_format($califData['calificacion'], 0) }}
                    @else
                        -
                    @endif
                </td>
            @endforeach
            <td>
                @php
                    $tieneEspecial = $alumno['calificacion_especial'] !== null;
                    $promedio = $tieneEspecial ? '-' : ($alumno['promedio_general'] !== null ? number_format($alumno['promedio_general'], 0) : 'Pend.');
                @endphp
                {{ $promedio }}
            </td>
            <td>
                @if($alumno['calificacion_especial'] !== null)
                    {{ number_format($alumno['calificacion_especial'], 0) }}
                @else
                    -
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="firma-section text-center">
    <div class="firma-line">
        <p><strong>_________________________________________</strong></p>
        <p><strong>Firma del Docente</strong></p>
        <p>{{ $docenteNombre }}</p>
    </div>
</div>

</body>
</html>