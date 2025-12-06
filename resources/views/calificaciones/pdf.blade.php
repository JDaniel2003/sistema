<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Acta de Calificaciones</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 5.6px;
            margin: 4mm;
            line-height: 1.05;
        }

        .header-table {
            width: 100%;
            border-collapse: collapse;
        }

        .header-logo {
            width: 22%;
            text-align: center;
            padding: 1px;
        }

        .header-logo img {
            width: 0px;
            height: auto;
            max-height: 30px;
        }

        .header-info {
            width: 78%;
            text-align: center;
            padding: 1px;
            font-size: 5.6px;
        }

        .header-info div {
            margin: 1px 0;
        }

        .header-info .title {
            font-weight: bold;
            font-size: 8.5px;
        }

        .header-info .subtitle {
            font-size: 7px;
        }

        .header-info .details {
            font-size: 6.5px;
            color: #333;
        }

        table.main {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            font-size: 5.6px;
        }

        th, td {
            border: 0.6px solid #000;
            padding: 1px;
            text-align: center;
            vertical-align: middle;
            height: 10.5px;
            line-height: 1.05;
            overflow: hidden;
        }

        .text-left {
            text-align: left !important;
            padding-left: 1.5px !important;
        }

        th {
            background-color: #f0f0f0;
            font-weight: bold;
            white-space: normal;
            word-wrap: break-word;
            padding: 0.8px 1px;
        }

        .sub-header {
            font-size: 4px !important;
            background-color: #e9e9e9 !important;
            font-weight: bold !important;
        }

        .calif-valor {
            font-weight: bold;
            font-size: 5.8px !important;
        }

        .eficiencia {
            font-weight: bold;
            font-size: 5.8px !important;
            background-color: #ffffff;
        }

        .footnote {
            font-size: 5px;
            margin-top: 3px;
            text-align: right;
            clear: both;
        }

       .fixed-footer {
            position: fixed;
            bottom: 8mm;
            left: 4mm;
            right: 4mm;
            font-size: 5.8px;
        }

        .sign-row {
            display: table;
            width: 100%;
            table-layout: fixed;
        }

        .sign-cell {
            display: table-cell;
            text-align: center;
            padding: 0 2px;
        }

        .sign-line {
            border-top: 0.8px solid #000;
            height: 14px;
            margin-bottom: 2px;
        }

        .sign-label {
            font-weight: bold;
            margin-top: 1px;
        }

        tr {
            page-break-inside: avoid;
        }
    </style>
</head>

<body>

<!-- Encabezado compacto -->
<table class="header-table">
    <tr>@php
        $logo = base64_encode(file_get_contents(public_path('libs/sbadmin/img/upn.png')));

    @endphp
        <td class="header-logo">
            <img src="data:image/png;base64,{{ $logo }}" style="width:130px;">

        </td>
        <td class="header-info">
            <div class="title">UNIVERSIDAD POLITÉCNICA DE NOCHIXTLÁN "ABRAHAM CASTELLANOS"</div>
            <div class="subtitle">ACTA DE CALIFICACIONES</div>
            <div class="details">
                AÑO: {{ date('Y') }} &nbsp;&nbsp;&nbsp;
                PERÍODO: {{ strtoupper($periodoNombre) ?? ' ' }} &nbsp;&nbsp;&nbsp;
                GRUPO: {{ strtoupper($grupoNombre) ?? ' ' }} &nbsp;&nbsp;&nbsp;
                MATERIA: {{ strtoupper($materiaNombre) ?? ' ' }}<br>
                CARRERA: {{ strtoupper($carreraNombre) ?? ' ' }}
            </div>
        </td>
    </tr>
</table>

<!-- Tabla principal -->
<table class="main">
     <thead>
                <tr>
                    <th rowspan="2" style="width: 2%">#</th>
                    <th rowspan="2" style="width: 5%">Matrícula</th>
                    <th rowspan="2" style="width: 15%">Nombre</th>
                    @foreach ($unidades as $unidad)
                        <th colspan="3">
                            <div><strong>UNIDAD {{ $unidad['numero_unidad'] }}:</strong></div>
                            <div>{{ $unidad['nombre_unidad'] }}</div>
                        </th>
                    @endforeach
                    <th rowspan="2" style="width: 5%">Promedio</th>
                    <th rowspan="2" style="width: 5%">Calificacion<br>Especial</th>
                    <th rowspan="2" style="width: 3%">Comp.<br>Prof.</th>
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
                <td class="text-left">{{ Str::limit($alumno['nombre'], 32, '…') }}</td>

                @foreach ($unidades as $unidad)
                    @php
                        $key = $alumno['id_alumno'] . '_' . $unidad['id_unidad'];
                        $califData = $alumno['calificaciones'][$key] ?? null;
                        $historial = $califData['historial_completo'] ?? [];

                        $ordinario = $recuperacion = $extraordinario = null;

                        foreach ($historial as $h) {
                            $tipo = $h['tipo'] ?? '';
                            if ($tipo === 'Ordinario') $ordinario = $h['calificacion'];
                            elseif ($tipo === 'Recuperación') $recuperacion = $h['calificacion'];
                            elseif ($tipo === 'Extraordinario') $extraordinario = $h['calificacion'];
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
                            : ($alumno['promedio_general'] !== null ? number_format($alumno['promedio_general'], 0) : 'Pend.');
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
                <td class="eficiencia">
                    @php
                        $califEficiencia = $alumno['calificacion_especial'] ?? $alumno['promedio_general'];
                        $eficiencia = 'N/A';
                        if ($califEficiencia !== null) {
                            $c = round($califEficiencia);
                            $eficiencia = ($c == 10) ? 'E' : (($c == 9) ? 'A' : (($c == 8) ? 'B' : (($c == 7) ? 'R' : 'NA')));
                        }
                    @endphp
                    {{ $eficiencia }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div style="font-size: 7px; text-align: right; margin: 5px 0; border: 1px solid #ffffff; padding: 3px;">
    <strong>COMPETENCIA PROFESIONAL:</strong> 
    <span style="margin: 0 3px;"><strong>E=10</strong> (Estratégico)</span> | 
    <span style="margin: 0 3px;"><strong>A=9</strong> (Autónomo)</span> | 
    <span style="margin: 0 3px;"><strong>B=8</strong> (Básico)</span> | 
    <span style="margin: 0 3px;"><strong>R=7</strong> (Receptivo)</span> | 
    <span style="margin: 0 3px;"><strong>NA=6</strong> (Preformal)</span>
</div>

<!-- Firmas compactas -->
<div class="fixed-footer">
    <div class="sign-row">
        <div class="sign-cell"><div class="sign-line"></div></div>
        <div class="sign-cell"><div class="sign-line"></div></div>
        <div class="sign-cell"><div class="sign-line"></div></div>
        <div class="sign-cell"><div class="sign-line"></div></div>
    </div>
    <div class="sign-row">
        <div class="sign-cell"><div>{{ strtoupper($docenteNombre) }}</div><div class="sign-label">DOCENTE</div></div>
        <div class="sign-cell"><div>{{ date('d/m/Y') }}</div><div class="sign-label">FECHA ENTREGA</div></div>
        <div class="sign-cell"><div>{{ strtoupper($directivoGeneralNombre) }}</div><div class="sign-label">{{ strtoupper($directivoGeneralCargo ) }}</div></div>
        <div class="sign-cell"><div>{{ strtoupper($directivoCarreraNombre) }}</div><div class="sign-label">{{ strtoupper($directivoCarreraCargo) }}</div></div>
    </div>
</div>

</body>
</html>