<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Usuarios</title>
    <link href="{{ asset('libs/fontawesome/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('libs/sbadmin/img/up_logo.png') }}">
    <link href="{{ asset('libs/sbadmin/css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>

<body id="page-top">
    <!-- Top Header -->
    <!-- Top Header -->
    <div class="bg-danger text-white1 text-center py-2">
        <div class="d-flex justify-content-between align-items-center px-4">
            <h4 class="mb-0" style="text-align: center;">SISTEMA DE CONTROL ESCOLAR</h4>
        </div>
    </div>

    <!-- Logout Modal -->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">¿Seguro de cerrar sesión?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Seleccione "Si" si desea finalizar su sesión.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">No</button>
                    <a class="btn btn-primary" href="{{ route('login') }}">Si</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dangerb">
        <div class="d-flex align-items-center">
            <div style="width: 300px; height: 120px;">
                <img src="{{ asset('libs/sbadmin/img/upn.png') }}" alt="Logo"
                    style="width: 100%; height: 100%; object-fit: cover;">
            </div>
        </div>
        <div class="collapse navbar-collapse ml-4">
            <ul class="navbar-nav" style="padding-left: 20%;">
                <li class="nav-item"><a class="nav-link text-white px-3 mr-1" href="{{ route('admin') }}">Inicio</a>
                </li>
                <li class="nav-item"><a class="nav-link text-white px-3 mr-1"
                        href="{{ route('periodos.index') }}">Períodos Escolares</a></li>
                <li class="nav-item"><a class="nav-link text-white px-3 mr-1"
                        href="{{ route('carreras.index') }}">Carreras</a></li>
                <li class="nav-item"><a class="nav-link text-white px-3 mr-1"
                        href="{{ route('materias.index') }}">Materias</a></li>
                <li class="nav-item"><a class="nav-link text-white px-3 mr-1" href="{{ route('planes.index') }}">Planes
                        de estudio</a></li>
                <li class="nav-item"><a class="nav-link text-white px-3 mr-1"
                        href="{{ route('alumnos.index') }}">Alumnos</a></li>
                <li class="nav-item"><a class="nav-link text-white px-3 mr-1"
                        href="{{ route('asignaciones.index') }}">Asignaciones Docentes</a></li>
                <li class="nav-item"><a class="nav-link text-white px-3"
                        href="{{ route('historial.index') }}">Historial</a></li>
                <li class="nav-item"><a class="nav-link text-white px-3"
                        href="{{ route('calificaciones.index') }}">Calificaciones</a></li>
            </ul>
        </div>
        <div class="position-absolute" style="top: 10px; right: 20px; z-index: 1000;">
            <div class="d-flex align-items-center text-white">
                <span class="mr-3">{{ Auth::user()->rol->nombre }}</span>
                <a href="#" class="text-white text-decoration-none logout-link" data-toggle="modal"
                    data-target="#logoutModal">
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
                    <h1 class="text-danger text-center mb-5"
                        style="font-size: 2.5rem; font-family: 'Arial Black', Verdana, sans-serif; font-weight: bold;">
                        Gestión de Usuarios
                    </h1>
                    <div class="row justify-content-center">
                        <div class="col-lg-10">
                            <div class="mb-3 text-right">
                                <button type="button" class="btn btn-success" data-toggle="modal"
                                    data-target="#crearUsuarioModal">
                                    <i class="fas fa-user-plus"></i> Nuevo Usuario
                                </button>
                            </div>
                            <div class="container mb-4 d-flex justify-content-center">
                                <div class="p-3 border rounded bg-light d-inline-block shadow-sm">
                                    <form method="GET" action="{{ route('usuarios.index') }}"
                                        class="d-flex flex-wrap gap-2 align-items-center">

                                        <div style="width: 500px;">
                                            <input type="text" id="searchInput"
                                                class="form-control form-control-sm" placeholder="🔍 Buscar">
                                        </div>
                                        <select name="mostrar" onchange="this.form.submit()"
                                            class="form-control form-control-sm w-auto">
                                            <option value="10" {{ request('mostrar') == 10 ? 'selected' : '' }}>10
                                            </option>
                                            <option value="13" {{ request('mostrar') == 13 ? 'selected' : '' }}>13
                                            </option>
                                            <option value="25" {{ request('mostrar') == 25 ? 'selected' : '' }}>25
                                            </option>
                                            <option value="50" {{ request('mostrar') == 50 ? 'selected' : '' }}>50
                                            </option>
                                            <option value="todo"
                                                {{ request('mostrar') == 'todo' ? 'selected' : '' }}>Todo</option>
                                        </select>
                                        <a href="{{ route('usuarios.index', ['mostrar' => 'todo']) }}"
                                            class="btn btn-sm btn-outline-secondary d-flex align-items-center">
                                            <i class="fas fa-list me-1"></i> Mostrar todo
                                        </a>
                                    </form>
                                </div>
                            </div>

                            @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif
                            @if (session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif

                            <div class="card-body1">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover text-center" id="teachersTable">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>Usuario</th>
                                                <th>Rol</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($usuarios as $usuario)
                                                <tr>
                                                    <td>{{ $usuario->username }}</td>
                                                    <td>{{ $usuario->rol->nombre ?? 'Sin rol' }}</td>

                                                    <td>
                                                        <!-- Ver -->
                                                        {{--  <button class="btn btn-info btn-sm" data-toggle="modal"
                                                            data-target="#verUsuarioModal{{ $usuario->id_usuario }}">
                                                            <i class="fas fa-eye"></i> Ver
                                                        </button> --}}
                                                        <!-- Editar -->
                                                        <button class="btn btn-warning btn-sm" data-toggle="modal"
                                                            data-target="#editarUsuarioModal{{ $usuario->id_usuario }}">
                                                            <i class="fas fa-edit"></i> Editar
                                                        </button>
                                                        <!-- Contraseña -->
                                                        <button class="btn btn-info btn-sm" data-toggle="modal"
                                                            data-target="#cambiarPasswordModal{{ $usuario->id_usuario }}">
                                                            <i class="fas fa-key"></i> Cambiar Contraseña
                                                        </button>
                                                        <!-- Eliminar -->
                                                        <!-- Botón que abre el modal -->
                                                        <button type="button" class="btn btn-danger btn-sm"
                                                            data-toggle="modal"
                                                            data-target="#eliminarUsuarioModal{{ $usuario->id_usuario }}">
                                                            <i class="fas fa-trash-alt"></i> Eliminar
                                                        </button>

                                                        <!-- Modal de confirmación -->
                                                        <div class="modal fade"
                                                            id="eliminarUsuarioModal{{ $usuario->id_usuario }}"
                                                            tabindex="-1" role="dialog">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div
                                                                        class="modal-header1 modal-header-custom border-0">
                                                                        <div class="w-100">
                                                                            <div class="modal-body text-center">
                                                                                <h5
                                                                                    class="modal-title d-flex align-items-center">
                                                                                    <i
                                                                                        class="fas fa-exclamation-triangle me-2"></i>
                                                                                    Confirmar Eliminación
                                                                                </h5>
                                                                            </div>
                                                                        </div>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Cerrar">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p class="mb-0">
                                                                            ¿Estás seguro de que deseas <strong>eliminar
                                                                                permanentemente</strong> al usuario
                                                                            <strong>{{ $usuario->nombre }}</strong>?
                                                                        </p>

                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button"
                                                                            class="btn btn-outline-secondary px-4"
                                                                            data-dismiss="modal">Cancelar</button>
                                                                        <form
                                                                            action="{{ route('usuarios.destroy', $usuario->id_usuario) }}"
                                                                            method="POST" style="display:inline;">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="submit"
                                                                                class="btn btn-danger">
                                                                                Eliminar
                                                                            </button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </td>
                                                </tr>

                                                <!-- Modal Ver Usuario -->
                                                <div class="modal fade"
                                                    id="verUsuarioModal{{ $usuario->id_usuario }}" tabindex="-1"
                                                    role="dialog">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-info text-white">
                                                                <h5 class="modal-title">👁️ Detalles del Usuario</h5>
                                                                <button type="button" class="close text-white"
                                                                    data-dismiss="modal" aria-label="Cerrar">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p><strong>Usuario:</strong> {{ $usuario->username }}
                                                                </p>
                                                                <p><strong>Contraseña:</strong>
                                                                    {{ $usuario->password }}</p>
                                                                <p><strong>Rol:</strong>
                                                                    {{ $usuario->rol->nombre ?? 'Sin rol' }}</p>
                                                                <p><strong>Estado:</strong>
                                                                    {{ $usuario->activo ? 'Activo' : 'Inactivo' }}</p>
                                                                <p><strong>Registrado:</strong>
                                                                    {{ $usuario->created_at ? $usuario->created_at->format('d/m/Y H:i') : '—' }}
                                                                </p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Cerrar</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Modal Editar Usuario -->
                                                <div class="modal fade"
                                                    id="editarUsuarioModal{{ $usuario->id_usuario }}" tabindex="-1"
                                                    role="dialog">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content border-0 shadow-lg">
                                                            <div class="modal-header modal-header-custom border-0">

                                                                <div class="w-100">
                                                                    <div class="text-center">
                                                                        <h5 class="m-0 font-weight-bold"
                                                                            id="nuevoPeriodoLabel">
                                                                            ✏️ Editar Usuario
                                                                        </h5>
                                                                    </div>
                                                                </div>
                                                                <button type="button" class="close text-white"
                                                                    data-dismiss="modal" aria-label="Cerrar"
                                                                    style="position: absolute; right: 1.5rem; top: 1.5rem; font-size: 1.8rem; opacity: 0.9;">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form
                                                                    action="{{ route('usuarios.update', $usuario->id_usuario) }}"
                                                                    method="POST">
                                                                    @csrf @method('PUT')
                                                                    <div class="row">
                                                                        <div class="col-md-6 mb-3">
                                                                            <label>Usuario <span
                                                                                    class="text-danger">*</span></label>
                                                                            <input type="text" name="username"
                                                                                class="form-control"
                                                                                value="{{ old('username', $usuario->username) }}"
                                                                                required>
                                                                        </div>
                                                                        <!-- ❌ CORREO ELIMINADO -->
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-6 mb-3">
                                                                            <label>Rol <span
                                                                                    class="text-danger">*</span></label>
                                                                            <select name="id_rol"
                                                                                class="form-control" required>
                                                                                @foreach ($roles as $rol)
                                                                                    <option
                                                                                        value="{{ $rol->id_rol }}"
                                                                                        {{ old('id_rol', $usuario->id_rol) == $rol->id_rol ? 'selected' : '' }}>
                                                                                        {{ $rol->nombre }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>

                                                                    </div>
                                                                    <div class="text-right mt-3">
                                                                        <button type="button"
                                                                            class="btn btn-secondary"
                                                                            data-dismiss="modal">Cancelar</button>
                                                                        <button type="submit"
                                                                            class="btn btn-primary">Actualizar</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Modal Cambiar Contraseña -->
                                                <div class="modal fade"
                                                    id="cambiarPasswordModal{{ $usuario->id_usuario }}"
                                                    tabindex="-1" role="dialog">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content rounded-4 shadow">
                                                            <div class="modal-header modal-header-custom border-0">
                                                                <div class="w-100">
                                                                    <div class="text-center">
                                                                        <h5 class="m-0 font-weight-bold"
                                                                            id="nuevoPeriodoLabel">
                                                                            🗝️ Cambiar Contraseña
                                                                        </h5>
                                                                    </div>
                                                                </div>
                                                                <button type="button" class="close text-white"
                                                                    data-dismiss="modal" aria-label="Cerrar"
                                                                    style="position: absolute; right: 1.5rem; top: 1.5rem; font-size: 1.8rem; opacity: 0.9;">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body p-4">
                                                                <form
                                                                    action="{{ route('usuarios.update', $usuario->id_usuario) }}"
                                                                    method="POST">
                                                                    @csrf @method('PUT')
                                                                    <input type="hidden" name="change_password"
                                                                        value="1">
                                                                    <div class="modal-body modal-body-custom p-4">
                                                                        <div
                                                                            class="form-container p-4 bg-white rounded shadow-sm border">
                                                                            <!-- Nueva Contraseña -->
                                                                            <div class="mb-4">
                                                                                <label class="form-label fw-bold">Nueva
                                                                                    Contraseña <span
                                                                                        class="text-danger">*</span></label>
                                                                                <div class="input-group">
                                                                                    <input type="password"
                                                                                        name="password"
                                                                                        id="passwordInput{{ $usuario->id_usuario }}"
                                                                                        class="form-control form-control-lg"
                                                                                        minlength="8" required>
                                                                                    <button
                                                                                        class="btn btn-outline-secondary"
                                                                                        type="button"
                                                                                        onclick="togglePasswordVisibility('passwordInput{{ $usuario->id_usuario }}')">
                                                                                        <i class="fas fa-eye"
                                                                                            id="toggleIcon{{ $usuario->id_usuario }}"></i>
                                                                                    </button>
                                                                                </div>
                                                                                <small
                                                                                    class="form-text text-muted">Mínimo
                                                                                    8 caracteres</small>
                                                                            </div>

                                                                            <!-- Confirmar Contraseña -->
                                                                            <div class="mb-4">
                                                                                <label
                                                                                    class="form-label fw-bold">Confirmar
                                                                                    Contraseña <span
                                                                                        class="text-danger">*</span></label>
                                                                                <div class="input-group">
                                                                                    <input type="password"
                                                                                        name="password_confirmation"
                                                                                        id="confirmPasswordInput{{ $usuario->id_usuario }}"
                                                                                        class="form-control form-control-lg"
                                                                                        required>
                                                                                    <button
                                                                                        class="btn btn-outline-secondary"
                                                                                        type="button"
                                                                                        onclick="togglePasswordVisibility('confirmPasswordInput{{ $usuario->id_usuario }}')">
                                                                                        <i class="fas fa-eye"
                                                                                            id="toggleConfirmIcon{{ $usuario->id_usuario }}"></i>
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <!-- Botones -->
                                                                    <div class="d-flex justify-content-end gap-2 mt-4">
                                                                        <button type="button"
                                                                            class="btn btn-outline-secondary px-4"
                                                                            data-dismiss="modal">Cancelar</button>
                                                                        <button type="submit"
                                                                            class="btn btn-success px-4">Actualizar
                                                                            Contraseña</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <script>
                                                    function togglePasswordVisibility(inputId) {
                                                        const input = document.getElementById(inputId);
                                                        const icon = document.getElementById('toggle' + (inputId === 'passwordInput{{ $usuario->id_usuario }}' ? '' :
                                                            'Confirm') + 'Icon{{ $usuario->id_usuario }}');
                                                        if (input.type === "password") {
                                                            input.type = "text";
                                                            icon.classList.remove("fa-eye");
                                                            icon.classList.add("fa-eye-slash");
                                                        } else {
                                                            input.type = "password";
                                                            icon.classList.remove("fa-eye-slash");
                                                            icon.classList.add("fa-eye");
                                                        }
                                                    }
                                                </script>

                                            @empty
                                                <tr>
                                                    <td colspan="4" class="text-muted text-center">No hay usuarios
                                                        registrados</td>
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

            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Sistema Control Escolar 2025</span>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Modal Crear Usuario -->
    <div class="modal fade" id="crearUsuarioModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content border-0 shadow-lg">

                <!-- Header con gradiente -->
                <div class="modal-header modal-header-custom border-0">
                    <div class="w-100">
                        <div class="text-center">
                            <h5 class="m-0 font-weight-bold" id="nuevoPeriodoLabel">
                                👨‍💻 Crear Nuevo Usuario
                            </h5>
                            <p class="m-0 mt-2 mb-0" style="font-size: 0.9rem; opacity: 0.95;">
                                Complete la información del usuario
                            </p>
                        </div>
                    </div>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Cerrar"
                        style="position: absolute; right: 1.5rem; top: 1.5rem; font-size: 1.8rem; opacity: 0.9;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>


                <form action="{{ route('usuarios.store') }}" method="POST">
                    @csrf

                    <div class="modal-body modal-body-custom p-4">
                        <div class="form-container p-4 bg-white rounded shadow-sm border">
                            <!-- Sección 1: Información Básica -->
                            <div class="card shadow mb-2 border-0">
                                <div class="card-body1 p-4">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label>Nombre de Usuario <span class="text-danger">*</span></label>
                                            <input type="text" name="username" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label>Contraseña <span class="text-danger">*</span></label>
                                            <input type="password" name="password" class="form-control"
                                                minlength="8" required>
                                            <div class="form-text">Mínimo 8 caracteres</div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label>Confirmar Contraseña <span class="text-danger">*</span></label>
                                            <input type="password" name="password_confirmation" class="form-control"
                                                required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label>Rol <span class="text-danger">*</span></label>
                                            <select name="id_rol" class="form-control" required>
                                                <option value="">-- Selecciona un rol --</option>
                                                @foreach ($roles as $rol)
                                                    <option value="{{ $rol->id_rol }}">{{ $rol->nombre }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ❌ CORREO ELIMINADO -->
                        <div class="text-right mt-3">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-success">Crear Usuario</button>
                        </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('libs/sbadmin/js/sb-admin-2.min.js') }}"></script>

    <script>
        // ===== BÚSQUEDA EN TABLA =====
        const searchInput = document.getElementById('searchInput');

        if (searchInput) {
            searchInput.addEventListener('input', function(e) {

                // Normaliza lo que escribe el usuario
                const searchTerm = e.target.value
                    .toLowerCase()
                    .replace(/\s+/g, ' ')
                    .trim();

                const table = document.getElementById('teachersTable');
                const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');

                for (let row of rows) {

                    // Normaliza el texto real de la fila
                    const text = row.textContent
                        .toLowerCase()
                        .replace(/\s+/g, ' ')
                        .trim();

                    if (text.includes(searchTerm)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                }
            });
        }
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
