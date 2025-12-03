<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Acta de Calificaciones</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 7.5px;
            margin: 10px;
        }

        .header {
            text-align: center;
            margin-bottom: 15px;
        }

        .header h2 {
            margin: 8px 0;
            font-size: 14px;
        }

        .header p {
            margin: 4px 0;
            font-size: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            table-layout: fixed;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 3px 2px;
            text-align: center;
            font-size: 6.5px;
            overflow: hidden;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
            white-space: normal;
            word-wrap: break-word;
        }

        .text-left {
            text-align: left !important;
        }

        .sub-header {
            font-size: 4.5px !important;
            background-color: #e9ecef !important;
        }

        .calif-valor {
            font-weight: bold;
            font-size: 7px !important;
        }

        .firma-section {
            margin-top: 25px;
            text-align: right;
        }

        .firma-line {
            border-top: 1px solid #000;
            margin-top: 25px;
            padding-top: 8px;
        }
    </style>
</head>

<body>

    <div class="header">
        <h2>ACTA DE CALIFICACIONES</h2>
        <p><strong>Materia:</strong> {{ $materiaNombre }}</p>
        <p><strong>Docente:</strong> {{ $docenteNombre }}</p>
        <p><strong>Grupo:</strong> {{ $grupoNombre }}</p>
        <p><strong>Período:</strong> {{ $periodoNombre }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th rowspan="2" style="width: 2%">#</th>
                <th rowspan="2" style="width: 5%">Matrícula</th>
                <th rowspan="2" style="width: 15%">Alumno</th>
                <!-- Unidades con número y nombre separados -->
                @foreach ($unidades as $unidad)
                    <th colspan="3">
                        <div><strong>Unidad {{ $unidad['numero_unidad'] }}:</strong></div>
                        <div>{{ $unidad['nombre_unidad'] }}</div>
                    </th>
                @endforeach
                <th rowspan="2" style="width: 5%">Promedio</th>
                <th rowspan="2" style="width: 5%">Calificación<br>Especial</th>
            </tr>
            <tr>
                @foreach ($unidades as $unidad)
                    <th class="sub-header" style="width: 2%">Ordinario</th>
                    <th class="sub-header" style="width: 2%">Recuperación</th>
                    <th class="sub-header" style="width: 2%">Extraordinario</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($alumnos as $index => $alumno)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $alumno['matricula'] }}</td>
                    <td class="text-left">{{ $alumno['nombre'] }}</td>

                    @foreach ($unidades as $unidad)
                        @php
                            $key = $alumno['id_alumno'] . '_' . $unidad['id_unidad'];
                            $califData = $alumno['calificaciones'][$key] ?? null;
                            $historial = $califData['historial_completo'] ?? [];

                            // Inicializar en null
                            $ordinario = null;
                            $recuperacion = null;
                            $extraordinario = null;

                            // Buscar en el historial con coincidencia EXACTA
                            foreach ($historial as $h) {
                                $tipo = $h['tipo'] ?? '';

                                if ($tipo === 'Ordinario') {
                                    $ordinario = $h['calificacion'];
                                } elseif ($tipo === 'Recuperación') {
                                    $recuperacion = $h['calificacion'];
                                } elseif ($tipo === 'Extraordinario') {
                                    $extraordinario = $h['calificacion'];
                                }
                                // Ignorar "Extraordinario Especial" aquí (va en columna aparte)
                            }
                        @endphp

                        <td>
                            @if ($ordinario !== null)
                                <span class="calif-valor">{{ number_format($ordinario, 0) }}</span>
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            @if ($recuperacion !== null)
                                <span class="calif-valor">{{ number_format($recuperacion, 0) }}</span>
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            @if ($extraordinario !== null)
                                <span class="calif-valor">{{ number_format($extraordinario, 0) }}</span>
                            @else
                                -
                            @endif
                        </td>
                    @endforeach

                    <td>
                        @php
                            $tieneEspecial = $alumno['calificacion_especial'] !== null;
                            $promedio = $tieneEspecial
                                ? '-'
                                : ($alumno['promedio_general'] !== null
                                    ? number_format($alumno['promedio_general'], 0)
                                    : 'Pend.');
                        @endphp
                        {{ $promedio }}
                    </td>
                    <td>
                        @if ($alumno['calificacion_especial'] !== null)
                            {{ number_format($alumno['calificacion_especial'], 0) }}
                        @else
                            -
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <br>

    <div class="text-center">
        <div>
            <p><strong>_________________________________________</strong></p>
            <p><strong>Firma del Docente</strong></p>
            <p>{{ $docenteNombre }}</p>
        </div>
    </div>

</body>

</html>
