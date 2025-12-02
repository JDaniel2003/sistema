<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Generaciones</title>
    <!-- Custom fonts -->
    <link href="{{ asset('libs/fontawesome/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('libs/sbadmin/img/up_logo.png') }}">
    <!-- Custom styles -->
    <link href="{{ asset('libs/sbadmin/css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>
<body id="page-top">
    <!-- Top Header -->
    <div class="bg-danger text-white1 text-center py-2">
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
                <div class="modal-body text-center">
                    <div class="mb-3">
                        <i class="fas fa-exclamation-circle text-warning" style="font-size: 4rem;"></i>
                    </div>
                    <h6 class="font-weight-bold mb-3">¿Desea cerrar su sesión?</h6>
                    <p class="text-muted mb-0">
                        Al cerrar sesión, será redirigido a la página de inicio de sesión.
                    </p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary px-4" type="button" data-dismiss="modal">
                        <i class="fas fa-times mr-2"></i>
                        Cancelar
                    </button>
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
        <div class="d-flex align-items-center">
            <div style="width: 300px; height: 120px;">
                <img src="{{ asset('libs/sbadmin/img/upn.png') }}" alt="Logo" style="width: 100%; height: 100%; object-fit: cover;">
            </div>
        </div>
        <div class="collapse navbar-collapse ml-4">
            <ul class="navbar-nav" style="padding-left: 27%;">
                <li class="nav-item">
                    <a class="nav-link text-white px-3 mr-1" href="{{ route('admin') }}">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white px-3 mr-1" href="{{ route('periodos.index') }}">Períodos Escolares</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white px-3 mr-1" href="{{ route('carreras.index') }}">Carreras</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white px-3 mr-1" href="{{ route('planes.index') }}">Planes de estudio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white px-3 mr-1" href="{{ route('alumnos.index') }}">Alumnos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white px-3 mr-1" href="#">Asignaciones Docentes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white px-3" href="{{ route('historial.index') }}">Historial</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white px-3" href="{{ route('calificaciones.index') }}">Calificaciones</a>
                </li>
            </ul>
        </div>
        <div class="position-absolute" style="top: 10px; right: 20px; z-index: 1000;">
            <div class="d-flex align-items-center text-white">
                <span class="mr-3">{{ Auth::user()->rol->nombre }}</span>
                <a href="#" class="text-white text-decoration-none logout-link" data-toggle="modal" data-target="#logoutModal">
                    Cerrar Sesión <i class="fas fa-sign-out-alt"></i>
                </a>
            </div>
        </div>
    </nav>

    <!-- Page Wrapper -->
    <div id="wrapper">
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <div class="container-fluid py-5">
                    <h1 class="text-danger text-center mb-5" style="font-size: 2.5rem; font-family: 'Arial Black', Verdana, sans-serif; font-weight: bold;">
                        Gestión de Generaciones
                    </h1>
                    <div class="row justify-content-center">
                        <div class="col-lg-10">
                            <!-- Botón para nueva generación -->
                            <div class="mb-3 text-right">
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#nuevaGeneracionModal">
                                    <i class="fas fa-plus"></i> Nueva Generación
                                </button>
                            </div>

                            <!-- Filtros -->
                            <div class="container mb-4 d-flex justify-content-center">
                                <div class="p-3 border rounded bg-light d-inline-block shadow-sm">
                                    <form id="filtrosForm" method="GET" action="{{ route('generaciones.index') }}" class="d-flex flex-wrap gap-2 align-items-center">
                                        <div class="flex-grow-1" style="width: 250px;">
                                            <input type="text" name="nombre" class="form-control form-control-sm" placeholder="🔍 Nombre" value="{{ request('nombre') }}">
                                        </div>
                                        <div style="width: 150px;">
                                            <input type="text" name="anio_inicio" class="form-control form-control-sm" placeholder="Año inicio" value="{{ request('anio_inicio') }}">
                                        </div>
                                        <div style="width: 150px;">
                                            <input type="text" name="anio_fin" class="form-control form-control-sm" placeholder="Año fin" value="{{ request('anio_fin') }}">
                                        </div>
                                        <select name="mostrar" onchange="this.form.submit()" class="form-control form-control-sm w-auto">
                                            <option value="10" {{ request('mostrar') == 10 ? 'selected' : '' }}>10</option>
                                            <option value="15" {{ request('mostrar') == 15 ? 'selected' : '' }}>15</option>
                                            <option value="25" {{ request('mostrar') == 25 ? 'selected' : '' }}>25</option>
                                            <option value="50" {{ request('mostrar') == 50 ? 'selected' : '' }}>50</option>
                                            <option value="todo" {{ request('mostrar') == 'todo' ? 'selected' : '' }}>Todo</option>
                                        </select>
                                        <a href="{{ route('generaciones.index', ['mostrar' => 'todo']) }}" class="btn btn-sm btn-outline-secondary d-flex align-items-center">
                                            <i class="fas fa-list me-1"></i> Mostrar todo
                                        </a>
                                    </form>
                                </div>
                            </div>

                            <!-- Mensaje de éxito -->
                            @if(session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            <!-- Tabla -->
                            <div class="card-body1">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead class="thead-dark text-center">
                                            <tr>
                                                <th>Nombre</th>
                                                <th>Año Inicio</th>
                                                <th>Año Fin</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($generaciones as $gen)
                                                <tr class="text-center">
                                                    <td>{{ $gen->nombre ?? '- - -' }}</td>
                                                    <td>{{ $gen->anio_inicio ?? '- - -' }}</td>
                                                    <td>{{ $gen->anio_fin ?? '- - -' }}</td>
                                                    <td>
                                                        <!-- Editar -->
                                                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editarModal{{ $gen->id_generacion }}">
                                                            <i class="fas fa-edit"></i> Editar
                                                        </button>

                                                        <!-- Eliminar -->
                                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#eliminarModal{{ $gen->id_generacion }}">
                                                            <i class="fas fa-trash-alt"></i> Eliminar
                                                        </button>
                                                    </td>
                                                </tr>

                                                <!-- Modal Editar -->
                                                <div class="modal fade" id="editarModal{{ $gen->id_generacion }}" tabindex="-1" role="dialog">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content border-0 shadow-lg">
                                                            <div class="modal-header modal-header-custom border-0">
                                                                <div class="w-100 text-center">
                                                                    <h5 class="m-0 font-weight-bold">
                                                                        ✏️ Editar Generación
                                                                    </h5>
                                                                </div>
                                                                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Cerrar"
                                                                    style="position: absolute; right: 1.5rem; top: 1.5rem; font-size: 1.8rem; opacity: 0.9;">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form action="{{ route('generaciones.update', $gen->id_generacion) }}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <input type="hidden" name="generacion_id" value="{{ $gen->id_generacion }}">
                                                                <div class="modal-body p-4">
                                                                    <div class="form-container p-4 bg-white rounded shadow-sm border">
                                                                        <div class="form-group mb-3">
                                                                            <label>Nombre (máx. 20 caracteres)</label>
                                                                            <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $gen->nombre) }}" maxlength="20">
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>Año Inicio</label>
                                                                                    <input type="date" name="anio_inicio" class="form-control" value="{{ old('anio_inicio', $gen->anio_inicio) }}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>Año Fin</label>
                                                                                    <input type="date" name="anio_fin" class="form-control" value="{{ old('anio_fin', $gen->anio_fin) }}">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                                        <i class="fas fa-times mr-2"></i> Cancelar
                                                                    </button>
                                                                    <button type="submit" class="btn btn-success">
                                                                        <i class="fas fa-save mr-2"></i> Actualizar
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Modal Eliminar -->
                                                <div class="modal fade" id="eliminarModal{{ $gen->id_generacion }}" tabindex="-1" role="dialog">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-danger">
                                                                <div class="w-100 text-center">
                                                                    <h5 class="m-0 font-weight-bold">
                                                                        🗑️ Eliminar Generación
                                                                    </h5>
                                                                </div>
                                                                <button class="close text-white" type="button" data-dismiss="modal" aria-label="Close"
                                                                    style="position: absolute; right: 1rem; top: 1rem; opacity: 0.9;">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body text-center">
                                                                ¿Seguro que deseas eliminar la generación <strong>{{ $gen->nombre ?? 'sin nombre' }}</strong>?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button class="btn btn-secondary px-4" type="button" data-dismiss="modal">
                                                                    <i class="fas fa-times mr-2"></i> Cancelar
                                                                </button>
                                                                <form action="{{ route('generaciones.destroy', $gen->id_generacion) }}" method="POST" style="display: inline;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-danger px-4">
                                                                        <i class="fas fa-trash-alt mr-2"></i> Eliminar
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @empty
                                                <tr>
                                                    <td colspan="4" class="text-center text-muted">No hay generaciones registradas</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Tu Web 2025</span>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Modal Nueva Generación -->
    <div class="modal fade" id="nuevaGeneracionModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header modal-header-custom border-0">
                    <div class="w-100 text-center">
                        <h5 class="m-0 font-weight-bold">
                            📚 Nueva Generación
                        </h5>
                        <p class="m-0 mt-2 mb-0" style="font-size: 0.9rem; opacity: 0.95;">
                            Complete la información de la nueva generación
                        </p>
                    </div>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Cerrar"
                        style="position: absolute; right: 1.5rem; top: 1.5rem; font-size: 1.8rem; opacity: 0.9;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('generaciones.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="is_create" value="1">
                    <div class="modal-body p-4">
                        <div class="form-container p-4 bg-white rounded shadow-sm border">
                            <div class="form-group mb-3">
                                <label>Nombre (máx. 20 caracteres)</label>
                                <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" maxlength="20">
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Año Inicio</label>
                                        <input type="date" name="anio_inicio" class="form-control" value="{{ old('anio_inicio') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Año Fin</label>
                                        <input type="date" name="anio_fin" class="form-control" value="{{ old('anio_fin') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            <i class="fas fa-times mr-2"></i> Cancelar
                        </button>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save mr-2"></i> Guardar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Scripts para reabrir modales si hay errores -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            @if ($errors->any() && old('is_create'))
                $('#nuevaGeneracionModal').modal('show');
            @endif
            @if ($errors->any() && old('generacion_id'))
                $('#editarModal{{ old("generacion_id") }}').modal('show');
            @endif
        });
    </script>

    <!-- Script para filtros en nombre (búsqueda automática) -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let form = document.getElementById("filtrosForm");
            if (form) {
                let nombreInput = form.querySelector('input[name="nombre"]');
                if (nombreInput) {
                    let typingTimer;
                    nombreInput.addEventListener("keyup", function() {
                        clearTimeout(typingTimer);
                        typingTimer = setTimeout(() => form.submit(), 500);
                    });
                }
                form.querySelectorAll("input[name='anio_inicio'], input[name='anio_fin']").forEach(el => {
                    el.addEventListener("change", () => form.submit());
                });
            }
        });
    </script>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('libs/sbadmin/js/sb-admin-2.min.js') }}"></script>
</body>
</html>