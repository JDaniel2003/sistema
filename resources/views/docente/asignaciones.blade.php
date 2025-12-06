<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Mis Asignaciones - Calificaciones</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('libs/fontawesome/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('libs/sbadmin/img/up_logo.png') }}">
    <!-- Custom styles for this template-->
    <link href="{{ asset('libs/sbadmin/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <style>
        /* ESTILOS COMPACTOS PARA CAPTURA DE CALIFICACIONES */

        /* Modal más compacto */
        .modal-header-custom {
            padding: 0.75rem 1rem !important;
        }

        .modal-body {
            padding: 0.5rem !important;
        }

        .modal-footer-custom {
            padding: 0.5rem 1rem !important;
        }

        /* Filtros compactos */
        .card.mb-3 .card-header {
            padding: 0.75rem !important;
            font-size: 0.95rem !important;
        }

        .card.mb-3 .card-body1 {
            padding: 1rem !important;
        }

        .card.mb-3 .form-control {
            padding: 0.375rem 0.5rem !important;
            font-size: 0.9rem !important;
            height: 36px !important;
        }

        .card.mb-3 label {
            font-size: 0.9rem !important;
            margin-bottom: 0.25rem !important;
        }

        .card.mb-3 .row.mt-3 {
            margin-top: 1rem !important;
        }

        /* Tabla matricial ultra compacta */
        #tablaCalificaciones th,
        #tablaCalificaciones td {
            padding: 4px 3px !important;
            font-size: 0.82rem !important;
            line-height: 1.2 !important;
            vertical-align: middle !important;
        }

        /* Celdas sticky más estrechas */
        #tablaCalificaciones th[style*="position: sticky"] {
            min-width: 40px !important;
            left: 0 !important;
        }

        #tablaCalificaciones th[style*="position: sticky"]+th {
            min-width: 90px !important;
            left: 40px !important;
        }

        #tablaCalificaciones th[style*="position: sticky"]+th+th {
            min-width: 180px !important;
            left: 130px !important;
        }

        /* Inputs de calificación compactos */
        .calificacion-input-matriz,
        .calificacion-input-especial {
            padding: 2px 4px !important;
            height: 28px !important;
            font-size: 0.85rem !important;
            width: 65px !important;
            margin: 2px auto !important;
            display: block !important;
        }

        /* Badges compactos */
        #tablaCalificaciones .badge {
            padding: 0.25em 0.4em !important;
            font-size: 1.3em !important;
            font-weight: 600 !important;
        }

        /* Textos pequeños */
        #tablaCalificaciones small {
            font-size: 0.7rem !important;
            line-height: 1.1 !important;
        }

        /* Encabezados de unidad */
        .unidad-header {
            min-width: 140px !important;
            font-size: 0.8rem !important;
            padding: 4px 2px !important;
        }

        /* Cabecera de tabla */
        #tablaCalificaciones thead {
            font-size: 0.8rem !important;
        }



        /* Botones pequeños */
        #btnLimpiarTodo,
        #btnExportarPDF,
        #btnGuardarCalificaciones {
            padding: 0.25rem 0.5rem !important;
            font-size: 0.8rem !important;
        }

        /* Card header compacto */
        .card-header.text-white {
            padding: 0.5rem 1rem !important;
            font-size: 0.9rem !important;
        }

        /* Card footer compacto */
        .card-footer.bg-light {
            padding: 0.5rem 1rem !important;
            font-size: 0.8rem !important;
        }

        /* Info materia */
        #infoMateria {
            font-size: 0.85rem !important;
        }

        /* Total alumnos badge */
        .badge-light strong {
            font-size: 0.9rem !important;
        }

        /* Espaciado reducido en filas */
        #tablaCalificaciones tbody tr {
            height: 38px !important;
        }

        /* Separadores más delgados */
        #tablaCalificaciones hr {
            margin: 0.25rem 0 !important;
            border-top: 1px solid #dee2e6 !important;
        }

        /* Tooltips más compactos */
        [title] {
            font-size: 0.75rem !important;
        }

        /* Iconos más pequeños */
        .fa-table,
        .fa-eraser,
        .fa-file-pdf,
        .fa-save {
            font-size: 0.85em !important;
        }

        /* Columnas de promedio y final */
        .bg-info.text-white,
        .unidad-header.bg-warning {
            font-size: 0.8rem !important;
            min-width: 80px !important;
        }

        /* Ajuste para inputs en celdas */
        #tablaCalificaciones td.text-center {
            padding: 2px !important;
        }

        /* Colores para aprobado/reprobado más sutiles */
        .unidad-aprobada {
            background-color: rgba(40, 167, 69, 0.08) !important;
            border-left: 2px solid #28a745 !important;
        }

        .unidad-reprobada {
            background-color: rgba(220, 53, 69, 0.08) !important;
            border-left: 2px solid #dc3545 !important;
        }

        /* Columna extraordinario especial */
        #tablaCalificaciones td[style*="background: #fff3cd"] {
            padding: 2px !important;
        }

        /* Botón cargar tabla */
        #btnCargarMatriz {
            padding: 0.375rem 0.75rem !important;
            font-size: 0.9rem !important;
        }

        /* Mensaje de ayuda */
        small.text-muted {
            font-size: 0.75rem !important;
            line-height: 1.2 !important;
        }

        /* Ajuste para pantallas pequeñas */
        @media (max-width: 768px) {

            #tablaCalificaciones th,
            #tablaCalificaciones td {
                font-size: 0.75rem !important;
                padding: 3px 2px !important;
            }

            .calificacion-input-matriz,
            .calificacion-input-especial {
                width: 55px !important;
                height: 26px !important;
                font-size: 0.8rem !important;
            }

            #contenedorTabla {
                max-height: 400px !important;
            }
        }
    </style>
</head>

<body id="page-top">
    <!-- Top Header -->
    <div class="bg-danger1 text-white1 text-center py-2">
        <div class="d-flex justify-content-between align-items-center px-4">
            <h4 class="mb-0" style="text-align: center;">SISTEMA DE CONTROL ESCOLAR</h4>
        </div>
    </div>

    <!-- Logout Modal -->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">

                    <div class="w-100 text-center">
                        <h5 class="m-0 font-weight-bold" id="logoutModalLabel">
                            <i class="fas fa-sign-out-alt mr-2"></i>
                            Cerrar Sesión
                        </h5>
                    </div>
                    <button class="close text-white" type="button" data-dismiss="modal" aria-label="Close"
                        style="position: absolute; right: 1rem; top: 1rem; opacity: 0.9;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!-- Body -->
                <div class="modal-body text-center">
                    <div class="mb-3">
                        <i class="fas fa-exclamation-circle text-warning" style="font-size: 4rem;"></i>
                    </div>
                    <h6 class="font-weight-bold mb-3">¿Desea cerrar su sesión?</h6>
                    <p class="text-muted mb-0">
                        Al cerrar sesión, será redirigido a la página de inicio de sesión.
                    </p>
                </div>

                <!-- Footer -->
                <div class="modal-footer">
                    <button class="btn btn-secondary px-4" type="button" data-dismiss="modal">
                        <i class="fas fa-times mr-2"></i>
                        Cancelar
                    </button>

                    <!-- Formulario para cerrar sesión -->
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-danger px-4">
                            <i class="fas fa-sign-out-alt mr-2"></i>
                            Cerrar Sesión
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dangerb">
        <div class="text-center">
            <div style="width: 300px; height: 120px;">
                <img src="{{ asset('libs/sbadmin/img/upn.png') }}" alt="Logo"
                    style="width: 90%; height: 90%; object-fit: cover;">
            </div>
        </div>

        <div class="collapse navbar-collapse ml-4">
            <ul class="navbar-nav" style="padding-left: 75%;">
                <li class="nav-item">
                    <a class="nav-link text-white px-3 mr-1" href="{{ route('docente.dashboard') }}">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link navbar-active-item px-3 mr-1" href="#">Mis Asignaciones</a>
                </li>
            </ul>
        </div>

        <div class="position-absolute" style="top: 10px; right: 20px; z-index: 1000;">
            <div class="d-flex align-items-center text-white">
                <span class="mr-3 small">{{ Auth::user()->rol->nombre }}</span>
                <a href="#" class="text-white text-decoration-none logout-link" data-toggle="modal"
                    data-target="#logoutModal">
                    Cerrar Sesión <i class="fas fa-sign-out-alt ml-1"></i>
                </a>
            </div>
        </div>
    </nav>

    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Begin Page Content -->
                <div class="container-fluid py-4">

                    <!-- Page Heading -->

                    <h1 class="text-danger1 text-center mb-5"
                        style="font-size: 2.5rem; font-family: 'Arial Black', Verdana, sans-serif; font-weight: bold;">
                        Mis Asignaciones
                    </h1>

                    <!-- Content Row -->
                    <div class="row">
                        <div class="col-12">
                            <!-- Encabezado formal -->
                            <div class="card border-0 shadow-sm mb-4">
                                <div class="card-body py-3">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <h4 class="font-weight-bold text-dark mb-1">{{ count($asignaciones) }}
                                                Materias Asignadas</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if ($asignaciones->isEmpty())
                                <!-- Mensaje cuando no hay asignaciones -->
                                <div class="card border-left-info shadow-lg">
                                    <div class="card-body text-center py-5">
                                        <div class="empty-state">
                                            <i class="fas fa-book-open fa-4x text-info mb-4"></i>
                                            <h3 class="font-weight-bold text-gray-700 mb-3">No tienes asignaciones</h3>
                                            <p class="text-muted mb-4">Actualmente no cuentas con materias asignadas
                                                para calificar.</p>
                                            <div class="alert alert-info border-0" role="alert">
                                                <div class="d-flex align-items-center">
                                                    <i class="fas fa-info-circle fa-lg mr-3"></i>
                                                    <div>
                                                        <h6 class="alert-heading mb-1">¿Necesitas asignaciones?</h6>
                                                        <p class="mb-0 small">Comunícate con el Departamento de
                                                            Servicios Escolares para que te asignen materias.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <!-- Listado de asignaciones - Estilo formal -->
                                <div class="card border-0 shadow-sm mb-4 ">

                                    <div class="card-body">
                                        <div class="row">
                                            @foreach ($asignaciones as $asignacion)
                                                <div class="col-md-6 col-lg-4 mb-4 ">
                                                    <div
                                                        class="card border h-100 logout-link card border-success h-100">
                                                        <div class="card-header bg-light border-bottom">
                                                            <div
                                                                class="d-flex justify-content-between align-items-center">
                                                                <h6 class="font-weight-bold text-dark mb-0">
                                                                    {{ Str::limit($asignacion['materia'], 40) }}
                                                                </h6>
                                                                <span class="badge badge-success badge-sm">
                                                                    <i class="fas fa-check-circle mr-1"></i>Activa
                                                                </span>
                                                            </div>
                                                        </div>

                                                        <div class="card-body ">
                                                            <!-- Información de la asignación -->
                                                            <div class="mb-3 ">
                                                                <div class="d-flex align-items-center mb-3">
                                                                    <div class="bg-primary-light rounded p-2 mr-3">
                                                                        <i class="fas fa-users text-primary"></i>
                                                                    </div>
                                                                    <div>
                                                                        <div
                                                                            class="text-xs font-weight-semibold text-uppercase text-muted">
                                                                            Grupo Asignado
                                                                        </div>
                                                                        <div class="h5 font-weight-bold text-dark">
                                                                            {{ $asignacion['grupo'] }}
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="d-flex align-items-center">
                                                                    <div class="bg-info-light rounded p-2 mr-3">
                                                                        <i class="fas fa-calendar-alt text-info"></i>
                                                                    </div>
                                                                    <div>
                                                                        <div
                                                                            class="text-xs font-weight-semibold text-uppercase text-muted">
                                                                            Período Académico
                                                                        </div>
                                                                        <div class="h5 font-weight-bold text-dark">
                                                                            {{ $asignacion['periodo'] }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>

                                                        <!-- Acción principal -->
                                                        <div class="card-footer bg-white border-top py-3">
                                                            <button class="btn btn-primary btn-block calificar-btn"
                                                                data-id-asignacion="{{ $asignacion['id_asignacion'] }}"
                                                                data-id-grupo="{{ $asignacion['id_grupo'] }}"
                                                                data-id-periodo="{{ $asignacion['id_periodo'] }}"
                                                                data-materia="{{ $asignacion['materia'] }}"
                                                                data-grupo="{{ $asignacion['grupo'] }}">
                                                                <div
                                                                    class="d-flex align-items-center justify-content-center">
                                                                    <span class="font-weight-semibold">Capturar
                                                                        Calificaciones</span>
                                                                </div>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Modal para calificar -->
    <!-- Modal para calificar -->
    <div class="modal fade" id="modalCalificar" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen" role="document">
            <div class="modal-content h-100 border-0">
                <!-- Modal Header -->
                <div class="modal-header bg-danger1">
                    <div class="w-100 text-center position-relative">
                        <h5 class="modal-title mb-0 font-weight-bold">
                            <i class="fas fa-graduation-cap mr-2"></i>
                            <span id="tituloModal">Captura de Calificaciones</span>
                        </h5>
                        <button type="button" class="close position-absolute text-white" data-dismiss="modal"
                            aria-label="Cerrar" style="right: 1.5rem; top: 50%; transform: translateY(-50%);">
                            <span aria-hidden="true" style="font-size: 1.8rem; color: white;">&times;</span>
                        </button>

                    </div>
                </div>

                <!-- Modal Body -->
                <div class="modal-body p-0 d-flex flex-column" style="height: calc(100vh - 150px);">
                    <form id="formCalificarGrupo" method="POST" action="{{ route('calificaciones.guardar') }}"
                        class="h-100 d-flex flex-column">
                        @csrf
                        <input type="hidden" id="calificacionesJsonInput" name="calificaciones_json">

                        <!-- Filtros -->
                        <div class="card border-left-primary shadow-sm mb-3 mx-3 mt-3">

                            <div class="card-body1">
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label class="font-weight-bold text-gray-700">Período Académico</label>
                                        <select id="periodoCalificar" class="form-control form-control-sm" disabled>
                                            <option value="">Seleccionar período</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="font-weight-bold text-gray-700">Grupo</label>
                                        <select id="grupoCalificar" class="form-control form-control-sm" disabled>
                                            <option value="">Seleccionar grupo</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="font-weight-bold text-gray-700">Materia</label>
                                        <select id="materiaCalificar" class="form-control form-control-sm" disabled>
                                            <option value="">Seleccionar materia</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Contenedor principal de la matriz -->
                        <div id="contenedorMatriz" class="flex-grow-1 mx-3 mb-3"
                            style="display: none; min-height: 0;">
                            <div class="card shadow-sm border h-100">
                                <!-- Header de la tabla -->
                                <div
                                    class="card-header py-3 d-flex justify-content-between align-items-center bg-white border-bottom">
                                    <div>
                                        <h6 class="m-0 font-weight-bold text-primary">
                                            <i class="fas fa-table mr-2"></i>Tabla de Calificaciones
                                        </h6>
                                        <span id="infoMateria" class="ml-3 text-muted small"></span>
                                    </div>
                                    <div>
                                        <span class="badge badge-light border">
                                            <i class="fas fa-users mr-1"></i> Alumnos: <strong
                                                id="totalAlumnos">0</strong>
                                        </span>
                                    </div>
                                </div>

                                <!-- Cuerpo de la tabla -->
                                <div class="card-body p-0 flex-grow-1">
                                    <div id="contenedorTabla" style="height: 100%; overflow: auto;">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover table-sm mb-0"
                                                id="tablaCalificaciones">
                                                <thead class="thead-light">
                                                    <tr></tr>
                                                </thead>
                                                <tbody id="bodyMatriz">
                                                    <tr>
                                                        <td colspan="100" class="text-center py-5">
                                                            <div class="spinner-border text-primary" role="status">
                                                            </div>
                                                            <p class="mt-3 text-muted">Cargando información de
                                                                alumnos...</p>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer bg-light border-top py-3">
                    <button type="button" class="btn btn-secondary btn-sm shadow-sm" data-dismiss="modal">
                        <i class="fas fa-times mr-2"></i>Cerrar
                    </button>
                    <button type="button" class="btn btn-outline-danger btn-sm mr-2" id="btnExportarPDF"
                        style="display: none;">
                        <i class="fas fa-file-pdf mr-2"></i>Exportar PDF
                    </button>
                    <button type="button" class="btn btn-outline-primary btn-sm mr-2" id="btnCargarMatriz">
                        <i class="fas fa-sync-alt mr-2"></i>Cargar Tabla de Alumnos
                    </button>
                    <button type="submit" class="btn btn-success btn-sm shadow-sm" id="btnGuardarCalificaciones"
                        form="formCalificarGrupo" disabled>
                        <i class="fas fa-save mr-2"></i>Guardar Calificaciones
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('libs/sbadmin/js/sb-admin-2.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            // Variables globales
            let datosMatriz = {
                alumnos: [],
                unidades: []
            };

            // Iconos y colores por tipo de evaluación
            const tiposEvaluacion = {
                'ordinario': {
                    icon: '',
                    color: '#007bff',
                    label: 'Ordinario'
                },
                'recuperación': {
                    icon: '',
                    color: '#28a745',
                    label: 'Recuperación'
                },
                'recuperacion': {
                    icon: '',
                    color: '#28a745',
                    label: 'Recuperación'
                },
                'extraordinario': {
                    icon: '',
                    color: '#dc3545',
                    label: 'Extraordinario'
                },
                'extraordinario_especial': {
                    icon: '',
                    color: '#6f42c1',
                    label: ''
                },
                'extraordinario especial': {
                    icon: '',
                    color: '#6f42c1',
                    label: ''
                }
            };

            // Evento para botón "Calificar"
            $(document).on('click', '.calificar-btn', function(e) {
                e.preventDefault();

                const datosModal = {
                    id_asignacion: $(this).data('id-asignacion'),
                    id_grupo: $(this).data('id-grupo'),
                    id_periodo: $(this).data('id-periodo'),
                    materia: $(this).data('materia'),
                    grupo: $(this).data('grupo')
                };

                console.log('Datos del modal:', datosModal);

                // Actualizar título
                $('#tituloModal').text(
                    `Calificar Alumnos de la materia: ${datosModal.materia} - ${datosModal.grupo}`);

                // Llenar selects
                $('#periodoCalificar').html(
                    `<option value="${datosModal.id_periodo}" selected>${datosModal.id_periodo}</option>`
                );
                $('#grupoCalificar').html(
                    `<option value="${datosModal.id_grupo}" selected>${datosModal.grupo}</option>`);
                $('#materiaCalificar').html(
                    `<option value="${datosModal.id_asignacion}" selected>${datosModal.materia}</option>`
                );

                // Mostrar modal
                $('#modalCalificar').modal('show');
            });

            // Cargar matriz
            $('#btnCargarMatriz').on('click', function() {
                const idGrupo = $('#grupoCalificar').val();
                const idPeriodo = $('#periodoCalificar').val();
                const idAsignacion = $('#materiaCalificar').val();
                const csrfToken = $('meta[name="csrf-token"]').attr('content');

                if (!idGrupo || !idPeriodo || !idAsignacion) {
                    alert('Faltan datos para cargar la matriz');
                    return;
                }

                const tbody = $('#bodyMatriz');
                tbody.html(
                    '<tr><td colspan="100" class="text-center py-4"><div class="spinner-border text-primary"></div><br>Cargando datos...</td></tr>'
                );
                $('#contenedorMatriz').show();

                const materiaText = $('#materiaCalificar option:selected').text();
                $('#infoMateria').html(`<span class="badge badge-light">${materiaText}</span>`);

                $.ajax({
                    url: '/calificaciones/matriz-completa',
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    contentType: 'application/json',
                    data: JSON.stringify({
                        id_grupo: idGrupo,
                        id_periodo: idPeriodo,
                        id_asignacion: idAsignacion
                    }),
                    success: function(data) {
                        console.log('=== RESPUESTA DEL SERVIDOR ===', data);
                        if (data.success) {
                            datosMatriz.alumnos = data.alumnos;
                            datosMatriz.unidades = data.unidades;
                            renderMatriz();
                        } else {
                            tbody.html(
                                `<tr><td colspan="100" class="text-center text-danger">Error: ${data.message || 'Error desconocido'}</td></tr>`
                            );
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error completo:', error);
                        tbody.html(
                            `<tr><td colspan="100" class="text-center text-danger">Error de conexión: ${error}</td></tr>`
                        );
                    }
                });
            });

            // Renderizar matriz
            function renderMatriz() {
                if (datosMatriz.alumnos.length === 0) {
                    $('#bodyMatriz').html(
                        '<tr><td colspan="100" class="text-center text-muted py-4">No hay alumnos en este grupo</td></tr>'
                    );
                    return;
                }

                // Ordenar alumnos por apellidos
                datosMatriz.alumnos.sort((a, b) => {
                    const nombreA = (a.nombre || '').trim();
                    const nombreB = (b.nombre || '').trim();
                    const partesA = nombreA.split(' ');
                    const partesB = nombreB.split(' ');
                    const primerApellidoA = partesA.length >= 2 ? partesA[partesA.length - 2] : nombreA;
                    const primerApellidoB = partesB.length >= 2 ? partesB[partesB.length - 2] : nombreB;
                    const apellidoCompare = primerApellidoA.localeCompare(primerApellidoB, 'es', {
                        sensitivity: 'base'
                    });
                    if (apellidoCompare !== 0) {
                        return apellidoCompare;
                    }
                    return nombreA.localeCompare(nombreB, 'es', {
                        sensitivity: 'base'
                    });
                });

                let headersUnidades = '';
                datosMatriz.unidades.forEach(unidad => {
                    headersUnidades +=
                        `<th class="unidad-header" style="min-width: 200px;">${unidad.nombre}</th>`;
                });
                headersUnidades += `<th class="bg-info text-white">Promedio</th>`;
                headersUnidades +=
                    `<th class="unidad-header bg-warning" style="min-width: 200px;">Extraordinario Especial</th>`;

                $('#tablaCalificaciones thead tr').html(`
            <th style="position: sticky; left: 0; z-index: 101; min-width: 50px;" class="text-center">#</th>
            <th style="position: sticky; left: 50px; z-index: 101; min-width: 120px;">Matrícula</th>
            <th style="position: sticky; left: 170px; z-index: 101; min-width: 250px;">Alumno</th>
            ${headersUnidades}
        `);

                let html = '';
                datosMatriz.alumnos.forEach((alumno, indexAlumno) => {
                    html += `
            <tr>
                <td class="text-center alumno-cell" style="position: sticky; left: 0; background: white; z-index: 10;">
                    ${indexAlumno + 1}
                </td>
                <td class="matricula-cell" style="position: sticky; left: 50px; background: white; z-index: 10;">
                    <strong>${alumno.matricula}</strong>
                </td>
                <td class="nombre-cell" style="position: sticky; left: 170px; background: white; z-index: 10;">
                    ${alumno.nombre}
                </td>`;

                    // Verificar si reprobó algún Extraordinario
                    let reproboExtraordinario = false;
                    Object.values(alumno.calificaciones).forEach(calif => {
                        if (calif?.tipo_evaluacion === 'Extraordinario' &&
                            calif.calificacion !== null &&
                            calif.calificacion < 7) {
                            reproboExtraordinario = true;
                        }
                    });

                    // Renderizar unidades con validación secuencial
                    datosMatriz.unidades.forEach((unidad, indexUnidad) => {
                        const key = `${alumno.id_alumno}_${unidad.id_unidad}`;
                        const calificacionData = alumno.calificaciones[key];
                        const tieneCalifEspecial = alumno.calificacion_especial !== null &&
                            alumno.calificacion_especial !== undefined;

                        // Contar unidades con calificación y verificar condiciones
                        let unidadesConCalificacion = 0;
                        let tieneExtraordinario = false;
                        const totalUnidades = datosMatriz.unidades.length;

                        Object.entries(alumno.calificaciones).forEach(([k, calif]) => {
                            if (calif?.calificacion !== null) {
                                unidadesConCalificacion++;
                            }
                            if (calif?.tipo_evaluacion === 'Extraordinario') {
                                tieneExtraordinario = true;
                            }
                        });

                        // Verificar la ÚLTIMA unidad y su estado
                        const ultimaUnidad = datosMatriz.unidades[totalUnidades - 1];
                        const keyUltimaUnidad = `${alumno.id_alumno}_${ultimaUnidad.id_unidad}`;
                        const califUltimaUnidad = alumno.calificaciones[keyUltimaUnidad];

                        let puedeHabilitarExtraordinario = false;
                        const todasLasUnidadesCompletas = unidadesConCalificacion >= totalUnidades;

                        if (todasLasUnidadesCompletas && califUltimaUnidad) {
                            const tipoUltimaUnidad = califUltimaUnidad.tipo_evaluacion;
                            const califUltimaAprobada = califUltimaUnidad.calificacion >= 7;

                            if (tipoUltimaUnidad === 'Extraordinario') {
                                puedeHabilitarExtraordinario = true;
                            } else if (tipoUltimaUnidad === 'Recuperación' && califUltimaUnidad
                                .calificacion !== null) {
                                puedeHabilitarExtraordinario = true;
                            } else if ((tipoUltimaUnidad === 'Ordinario' || tipoUltimaUnidad ===
                                    'Regularización') && califUltimaAprobada) {
                                puedeHabilitarExtraordinario = true;
                            }
                        }

                        // Verificar si unidades anteriores están completadas
                        let puedeCapturarEstaUnidad = false;
                        let mensajeError = '';

                        if (indexUnidad === 0) {
                            puedeCapturarEstaUnidad = !tieneCalifEspecial && !reproboExtraordinario;
                        } else {
                            const unidadAnterior = datosMatriz.unidades[indexUnidad - 1];
                            const keyAnterior = `${alumno.id_alumno}_${unidadAnterior.id_unidad}`;
                            const califAnterior = alumno.calificaciones[keyAnterior];

                            if (!califAnterior || califAnterior.calificacion === null) {
                                mensajeError = 'Captura la unidad anterior primero';
                            } else if (califAnterior.calificacion < 0) {
                                mensajeError = 'La unidad anterior debe estar aprobada';
                            } else {
                                puedeCapturarEstaUnidad = !tieneCalifEspecial && !
                                    reproboExtraordinario;
                            }
                        }

                        // LÓGICA ESPECIAL: Si la unidad actual ES un Extraordinario
                        const esExtraordinarioActual = calificacionData?.tipo_evaluacion ===
                            'Extraordinario';

                        if (esExtraordinarioActual && !puedeHabilitarExtraordinario) {
                            puedeCapturarEstaUnidad = false;
                            if (!todasLasUnidadesCompletas) {
                                mensajeError = '🔒 Completa todas las unidades primero';
                            } else if (califUltimaUnidad?.tipo_evaluacion === 'Recuperación' &&
                                califUltimaUnidad.calificacion < 7) {
                                mensajeError = '🔒 Aprueba la Recuperación de la última unidad';
                            } else {
                                mensajeError = '🔒 Completa todos los requisitos';
                            }
                        }

                        // Forzar bloqueo si hay calificación especial o extraordinario reprobado
                        if (tieneCalifEspecial || reproboExtraordinario) {
                            puedeCapturarEstaUnidad = false;
                            mensajeError = reproboExtraordinario ? ' ' :
                                '🔒 Calificación especial asignada';
                        }

                        if (!calificacionData) {
                            if (mensajeError) {
                                html +=
                                    `<td class="text-center p-2 text-muted" title="${mensajeError}">${mensajeError}</td>`;
                            } else {
                                html += `<td class="text-center p-2">-</td>`;
                            }
                            return;
                        }

                        const calificacion = calificacionData.calificacion;
                        const yaCapturado = calificacion !== null;
                        const esAprobatoria = calificacion >= 7;
                        const siguienteEval = calificacionData.siguiente_evaluacion;

                        let puedeCapturar = puedeCapturarEstaUnidad && calificacionData
                            .puede_capturar;

                        if (siguienteEval?.tipo === 'Extraordinario' && !
                            puedeHabilitarExtraordinario) {
                            puedeCapturar = false;
                            if (!todasLasUnidadesCompletas) {
                                mensajeError = 'Extraordinario Pendiente';
                            } else if (califUltimaUnidad?.tipo_evaluacion === 'Recuperación' &&
                                califUltimaUnidad.calificacion < 7) {
                                mensajeError = '🔒 Aprueba la Recuperación de la última unidad';
                            } else {
                                mensajeError = '🔒 Completa todos los requisitos';
                            }
                        }

                        if (yaCapturado) {
                            const tipoEvaluacion = calificacionData.tipo_evaluacion || 'Ordinario';
                            const nombreEvaluacion = calificacionData.nombre_evaluacion ||
                                'Evaluación';
                            const historialCompleto = calificacionData.historial_completo || [];
                            const tipoKey = tipoEvaluacion.toLowerCase().replace('ó', 'o').replace(
                                'ú', 'u');
                            const tipoEval = tiposEvaluacion[tipoKey] || tiposEvaluacion[
                                'ordinario'];

                            let tooltipHistorial = '';
                            if (historialCompleto.length > 1) {
                                tooltipHistorial = 'Historial:\n' +
                                    historialCompleto.map((h, i) =>
                                        `${i + 1}. ${h.tipo}: ${h.calificacion}`).join('\n');
                            }

                            if (puedeCapturar && siguienteEval) {
                                const siguienteTipoKey = siguienteEval.tipo.toLowerCase().replace(
                                    'ó', 'o').replace('ú', 'u');
                                const siguienteTipoInfo = tiposEvaluacion[siguienteTipoKey] ||
                                    tiposEvaluacion['ordinario'];

                                html += `
                        <td class="text-center p-2" style="vertical-align: middle;">
                            <div class="d-flex flex-column align-items-center">
                                <span class="badge mb-2" 
                                      style="font-size: 0.9rem; padding: 0.4rem; color: ${esAprobatoria ? '#28a745' : '#dc3545'}; cursor: help;"
                                      ${tooltipHistorial ? `title="${tooltipHistorial.replace(/"/g, '&quot;')}"` : ''}>
                                     ${calificacion} ${tipoEval.icon}
                                </span>
                                ${historialCompleto.length > 1 ? `<small class="text-muted mb-2" style="font-size: 0.7rem;"></small>` : ''}
                                <hr style="width: 100%; margin: 0.5rem 0; border-top: 1px dashed #ddd;">
                                <input type="number" 
                                       class="form-control calificacion-input-matriz text-center mt-2" 
                                       data-alumno="${alumno.id_alumno}"
                                       data-unidad="${unidad.id_unidad}"
                                       data-evaluacion="${siguienteEval.id_evaluacion}"
                                       data-tipoeval="${siguienteTipoKey}"
                                       min="0" 
                                       max="10" 
                                       step="0.1"
                                       placeholder="Nueva calif."
                                       style="width: 100px; margin: 0 auto;">
                                <small class=" mt-1" style="color: ${siguienteTipoInfo.color};">
                                    ${siguienteTipoInfo.icon} ${siguienteEval.tipo}
                                </small>
                            </div>
                        </td>`;
                            } else {
                                html += `
                        <td class="text-center p-2" style="vertical-align: middle;">
                            <div class="d-flex flex-column align-items-center">
                                <span class="badge mb-1" 
                                      style="font-size: 1.1rem; padding: 0.5rem; color: ${esAprobatoria ? '#28a745' : '#dc3545'}; cursor: help;"
                                      ${tooltipHistorial ? `title="${tooltipHistorial.replace(/"/g, '&quot;')}"` : ''}>
                                    ${calificacion}
                                </span>
                                <small style="color: ${tipoEval.color};">
                                    ${tipoEval.icon} ${tipoEval.label}
                                </small>
                                ${mensajeError ? `<small class="text-warning mt-1" style="font-size: 0.75rem;">${mensajeError}</small>` : esAprobatoria ? `<small class="text-success mt-1" style="font-size: 0.8rem;"></small>` : `<small class="text-muted mt-1" style="font-size: 0.8rem;"></small>`}
                            </div>
                        </td>`;
                            }
                        } else {
                            if (puedeCapturar && siguienteEval) {
                                const tipoKey = siguienteEval.tipo.toLowerCase().replace('ó', 'o')
                                    .replace('ú', 'u');
                                const tipoInfo = tiposEvaluacion[tipoKey] || tiposEvaluacion[
                                    'ordinario'];

                                html += `
                        <td class="text-center p-2" style="vertical-align: middle;">
                            <input type="number" 
                                   class="form-control calificacion-input-matriz text-center" 
                                   data-alumno="${alumno.id_alumno}"
                                   data-unidad="${unidad.id_unidad}"
                                   data-evaluacion="${siguienteEval.id_evaluacion}"
                                   data-tipoeval="${tipoKey}"
                                   min="0" 
                                   max="10" 
                                   step="0.1"
                                   placeholder="0.0"
                                   style="width: 100px; margin: 0 auto;">
                            <small class=" mt-1" style="color: ${tipoInfo.color};">
                                ${tipoInfo.icon} ${siguienteEval.tipo}
                            </small>
                        </td>`;
                            } else {
                                html +=
                                    `<td class="text-center p-2 text-muted" title="${mensajeError || 'Completado'}">${mensajeError || 'Completado'}</td>`;
                            }
                        }
                    });

                    // Columna de Promedio General
                    const tieneCalifEspecial = alumno.calificacion_especial !== null && alumno
                        .calificacion_especial !== undefined;
                    if (tieneCalifEspecial) {
                        html +=
                            `<td class="text-center p-2 bg-light text-muted" style="font-size: 0.8rem;">-</td>`;
                    } else {
                        const promedioGeneral = alumno.promedio_general;
                        if (promedioGeneral !== null && promedioGeneral !== undefined && !isNaN(
                                promedioGeneral)) {
                            const promedioRedondeado = Math.round(promedioGeneral);
                            const esAprobado = promedioRedondeado >= 7;
                            html += `
                    <td class="text-center p-2 bg-light" style="vertical-align: middle;">
                        <span class="badge" style="font-size: 1.2rem; padding: 0.6rem; color: ${esAprobado ? '#003ded' : '#6c757d'};">
                            ${promedioRedondeado}
                        </span>
                        <small class="d-block mt-1 text-muted" style="font-size: 0.7rem;"></small>
                    </td>`;
                        } else {
                            html +=
                                `<td class="text-center p-2 bg-light text-muted" style="font-size: 0.8rem;">Pendiente</td>`;
                        }
                    }

                    // Columna Extraordinario Especial
                    const tipoEvalEspecial = tiposEvaluacion['extraordinario_especial'] || {
                        icon: '',
                        color: '#6f42c1',
                        label: ''
                    };

                    if (tieneCalifEspecial) {
                        const esAprob = alumno.calificacion_especial >= 7;
                        html += `
                <td class="text-center p-2" style="vertical-align: middle; background: #fff3cd; border-left: 3px solid #6f42c1;">
                    <div class="d-flex flex-column align-items-center">
                        <span class="badge mb-1" style="font-size: 1.2rem; padding: 0.6rem; color: ${esAprob ? '#28a745' : '#dc3545'};">
                            ${alumno.calificacion_especial}
                        </span>
                        <small style="color: ${tipoEvalEspecial.color}; font-weight: bold;">
                            ${tipoEvalEspecial.icon} ${tipoEvalEspecial.label}
                        </small>
                        ${esAprob ? `<small class="text-success mt-1"></small>` : `<small class="text-danger mt-1"></small>`}
                        <small class="text-muted mt-1" style="font-size: 0.7rem;"></small>
                    </div>
                </td>`;
                    } else if (reproboExtraordinario) {
                        if (alumno.evaluacion_especial) {
                            const evalEspecial = alumno.evaluacion_especial;
                            html += `
                    <td class="text-center p-2" style="vertical-align: middle; background: #fff3cd; border-left: 3px solid #dc3545;">
                        <input type="number" 
                               class="form-control calificacion-input-especial text-center" 
                               data-alumno="${alumno.id_alumno}"
                               data-evaluacion="${evalEspecial.id_evaluacion}"
                               min="0" max="10" step="0.1" placeholder="Calif."
                               style="width: 90px; margin: 0 auto; border: 3px solid #dc3545; font-weight: bold;">
                        <small class="d-block text-danger mt-1" style="font-size: 0.65rem; font-weight: bold;"></small>
                    </td>`;
                        } else {
                            html += `<td class="text-center p-2 bg-light text-muted">-</td>`;
                        }
                    } else {
                        let hayExtraordinarioReprobado = false;
                        datosMatriz.unidades.forEach(unidad => {
                            const key = `${alumno.id_alumno}_${unidad.id_unidad}`;
                            const califData = alumno.calificaciones[key];
                            if (califData && califData.calificacion !== null && califData
                                .calificacion < 7 && califData.tipo_evaluacion === 'Extraordinario'
                            ) {
                                hayExtraordinarioReprobado = true;
                            }
                        });

                        if (hayExtraordinarioReprobado && alumno.evaluacion_especial && !
                            reproboExtraordinario) {
                            const evalEspecial = alumno.evaluacion_especial;
                            html += `
                    <td class="text-center p-2" style="vertical-align: middle; background: #fff3cd; border-left: 3px solid #dc3545;">
                        <input type="number" 
                               class="form-control calificacion-input-especial text-center" 
                               data-alumno="${alumno.id_alumno}"
                               data-evaluacion="${evalEspecial.id_evaluacion}"
                               min="0" max="10" step="0.1" placeholder="Calif."
                               style="width: 90px; margin: 0 auto; border: 3px solid #dc3545; font-weight: bold;">
                        <small class="d-block mt-2" style="color: #6f42c1; font-weight: bold; font-size: 0.75rem;">
                            🎓 ${evalEspecial.nombre}
                        </small>
                        <small class="d-block text-danger mt-1" style="font-size: 0.65rem; font-weight: bold;">
                            📚 Examen de toda la materia
                        </small>
                    </td>`;
                        } else {
                            html += `<td class="text-center p-2 bg-light text-muted">-</td>`;
                        }
                    }

                    html += '</tr>';
                });

                $('#bodyMatriz').html(html);
                $('#totalAlumnos').text(datosMatriz.alumnos.length);

                // Eventos para inputs de unidades
                $('.calificacion-input-matriz').on('input', function() {
                    const valor = parseFloat($(this).val());
                    if ($(this).val() && (valor < 0 || valor > 10 || isNaN(valor))) {
                        $(this).addClass('is-invalid');
                    } else {
                        $(this).removeClass('is-invalid');
                    }
                    validarGuardar();
                });

                $('.calificacion-input-matriz').on('keydown', function(e) {
                    if (['ArrowUp', 'ArrowDown', 'ArrowLeft', 'ArrowRight'].includes(e.key)) {
                        e.preventDefault();
                        navegarCelda(this, e.key);
                    }
                });

                // Eventos para inputs de Extraordinario Especial
                $('.calificacion-input-especial').on('input', function() {
                    const valor = parseFloat($(this).val());
                    if ($(this).val() && (valor < 0 || valor > 10 || isNaN(valor))) {
                        $(this).addClass('is-invalid');
                    } else {
                        $(this).removeClass('is-invalid');
                    }
                    validarGuardar();
                });

                validarGuardar();
                // Activar botón de PDF cuando se carga la matriz
                document.getElementById('btnExportarPDF').style.display = 'inline-block';
            }

            // Navegación con teclado
            function navegarCelda(inputActual, tecla) {
                const inputs = $('.calificacion-input-matriz').toArray();
                const indexActual = inputs.indexOf(inputActual);
                let nuevoIndex = indexActual;
                const columnas = datosMatriz.unidades.length;

                switch (tecla) {
                    case 'ArrowLeft':
                        nuevoIndex = indexActual - columnas;
                        break;
                    case 'ArrowRight':
                        nuevoIndex = indexActual + columnas;
                        break;
                    case 'ArrowUp':
                        nuevoIndex = indexActual - 1;
                        break;
                    case 'ArrowDown':
                        nuevoIndex = indexActual + 1;
                        break;
                }

                if (nuevoIndex >= 0 && nuevoIndex < inputs.length) {
                    $(inputs[nuevoIndex]).focus().select();
                }
            }

            // Validar si se puede guardar
            function validarGuardar() {
                const inputsUnidades = $('.calificacion-input-matriz');
                const inputsEspeciales = $('.calificacion-input-especial');
                let hayCalificacionesValidas = false;

                inputsUnidades.each(function() {
                    if ($(this).val() && !$(this).hasClass('is-invalid') && $(this).data('evaluacion')) {
                        hayCalificacionesValidas = true;
                    }
                });

                inputsEspeciales.each(function() {
                    if ($(this).val() && !$(this).hasClass('is-invalid')) {
                        hayCalificacionesValidas = true;
                    }
                });

                $('#btnGuardarCalificaciones').prop('disabled', !hayCalificacionesValidas);
            }

            // Limpiar calificaciones
            $('#btnLimpiarTodo').on('click', function() {
                if (confirm('¿Estás seguro de limpiar todas las calificaciones no guardadas?')) {
                    $('.calificacion-input-matriz, .calificacion-input-especial').val('').removeClass(
                        'is-invalid');
                    validarGuardar();
                }
            });


            // Guardar
            $('#btnGuardarCalificaciones').on('click', function(e) {
                e.preventDefault();

                const calificaciones = [];
                const calificacionesEspeciales = [];

                $('.calificacion-input-matriz').each(function() {
                    if ($(this).val() && !$(this).hasClass('is-invalid')) {
                        calificaciones.push({
                            id_alumno: parseInt($(this).data('alumno')),
                            id_unidad: parseInt($(this).data('unidad')),
                            id_evaluacion: parseInt($(this).data('evaluacion')),
                            calificacion: parseFloat($(this).val())
                        });
                    }
                });

                $('.calificacion-input-especial').each(function() {
                    if ($(this).val() && !$(this).hasClass('is-invalid')) {
                        calificacionesEspeciales.push({
                            id_alumno: parseInt($(this).data('alumno')),
                            id_evaluacion: parseInt($(this).data('evaluacion')),
                            calificacion_especial: parseFloat($(this).val())
                        });
                    }
                });

                if (calificaciones.length === 0 && calificacionesEspeciales.length === 0) {
                    alert('Ingresa al menos una calificación');
                    return;
                }

                const data = {
                    id_asignacion: $('#materiaCalificar').val(),
                    calificaciones: calificaciones,
                    calificaciones_especiales: calificacionesEspeciales
                };

                $('#calificacionesJsonInput').val(JSON.stringify(data));
                $(this).html('<i class="fas fa-spinner fa-spin mr-1"></i> Guardando...').prop('disabled',
                    true);
                $('#formCalificarGrupo').submit();
            });

            // Reset al cerrar modal
            $('#modalCalificar').on('hidden.bs.modal', function() {
                $('#formCalificarGrupo')[0].reset();
                $('#bodyMatriz').empty();
                $('#contenedorMatriz').hide();
                datosMatriz = {
                    alumnos: [],
                    unidades: []
                };
                $('#btnGuardarCalificaciones').prop('disabled', true).html(
                    '<i class="fas fa-save mr-1"></i> Guardar Calificaciones');
            });
        });
        // Exportar matriz actual a PDF
        document.getElementById('btnExportarPDF')?.addEventListener('click', function() {
            const idGrupo = document.getElementById('grupoCalificar').value;
            const idPeriodo = document.getElementById('periodoCalificar').value;
            const idAsignacion = document.getElementById('materiaCalificar').value;

            if (!idGrupo || !idPeriodo || !idAsignacion) {
                alert('Selecciona una materia primero');
                return;
            }

            // Abrir en nueva pestaña para descargar PDF
            const url =
                `/calificaciones/exportar-pdf?grupo=${idGrupo}&periodo=${idPeriodo}&materia=${idAsignacion}`;
            window.open(url, '_blank');
        });
    </script>
    <script>
        $(document).ready(function() {
            // Espera un poco para asegurar que todos los modales existan
            setTimeout(function() {
                $('.modal').each(function() {
                    // Inicializa el modal con las opciones deseadas
                    $(this).modal({
                        backdrop: 'static',
                        keyboard: false,
                        show: false // no mostrar al cargar
                    });
                });
            }, 500);
        });
    </script>
</body>

</html>
