<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Ciclos Escolares</title>

    <link href="{{ asset('libs/fontawesome/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('libs/sbadmin/img/up_logo.png') }}">
    <link href="{{ asset('libs/sbadmin/css/sb-admin-2.min.css') }}" rel="stylesheet">
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
                <div class="modal-body text-center">
                    <div class="mb-3">
                        <i class="fas fa-exclamation-circle text-warning" style="font-size: 4rem;"></i>
                    </div>
                    <h6 class="font-weight-bold mb-3">¿Desea cerrar su sesión?</h6>
                    <p class="text-muted mb-0">Al cerrar sesión, será redirigido a la página de inicio de sesión.</p>
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
        <div class="text-center">
            <div style="width: 300px; height: 120px; ">
                <img src="{{ asset('libs/sbadmin/img/upn.png') }}" alt="Logo"
                    style="width: 90%; height: 90%; object-fit: cover;">
            </div>
        </div>

        <div class="collapse navbar-collapse ml-4">
            <ul class="navbar-nav" style="padding-left: 28%;">
                <li class="nav-item"><a class="nav-link text-white px-3 mr-1" href="{{ route('admin') }}">Inicio</a>
                </li>
                <li class="nav-item"><a class="nav-link text-white px-3 mr-1"
                        href="{{ route('periodos.index') }}">Períodos Escolares</a></li>
                <li class="nav-item"><a class="nav-link text-white px-3 mr-1"
                        href="{{ route('carreras.index') }}">Carreras</a></li>
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

                <!-- Main Content -->
                <div class="container-fluid py-4">
                    <h1 class="text-danger1 text-center mb-5"
                        style="font-size: 2.5rem; font-weight: bold; font-family: 'Arial Black', Verdana, sans-serif;">
                        Gestión de Ciclos Escolares
                    </h1>
                    <div class="row justify-content-center">
                        <div class="col-lg-11">
                            <div class="mb-3 text-right">

                                <button type="button" class="btn btn-success" data-toggle="modal"
                                    data-target="#createModal">
                                    <i class="fas fa-plus"></i> Nuevo Ciclo Escolar
                                </button>
                            </div>


                            <!-- Filters and Actions -->
                            <div class="container mb-4 d-flex justify-content-center">
                                <div class="p-3 border rounded bg-light d-inline-block shadow-sm">
                                    <form method="GET" action="{{ route('ciclos.index') }}"
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
                                        <a href="{{ route('ciclos.index', ['mostrar' => 'todo']) }}"
                                            class="btn btn-sm btn-outline-secondary d-flex align-items-center">
                                            <i class="fas fa-list me-1"></i> Mostrar todo
                                        </a>
                                    </form>
                                </div>
                            </div>
                            <!-- Alerts -->
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <!-- Table -->

                            <div class="table-responsive">
                                <table class="table table-bordered table-hover text-center" id="teachersTable"
                                    width="100%">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Fecha Inicio</th>
                                            <th>Fecha Fin</th>
                                            <th>Duración</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($ciclos as $ciclo)
                                            <tr>
                                                <td><strong>{{ $ciclo->nombre }}</strong></td>
                                                <td>{{ \Carbon\Carbon::parse($ciclo->fecha_inicio)->format('d/m/Y') }}
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($ciclo->fecha_fin)->format('d/m/Y') }}
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($ciclo->fecha_inicio)->diffInDays($ciclo->fecha_fin) }}
                                                    días</td>
                                                <td>
                                                    @if ($ciclo->estado == 'Activo')
                                                        <span>Activo</span>
                                                    @else
                                                        <span>Inactivo</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-warning" data-toggle="modal"
                                                        data-target="#editModal{{ $ciclo->id_ciclo }}">
                                                        <i class="fas fa-edit"></i> Editar
                                                    </button>
                                                    <button class="btn btn-sm btn-danger" data-toggle="modal"
                                                        data-target="#deleteModal{{ $ciclo->id_ciclo }}">
                                                        <i class="fas fa-trash"></i> Eliminar
                                                    </button>
                                                </td>
                                            </tr>

                                            <!-- Edit Modal -->
                                            <div class="modal fade" id="editModal{{ $ciclo->id_ciclo }}" tabindex="-1" role="dialog" aria-labelledby="editarCicloLabel{{ $ciclo->id_ciclo }}" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content border-0 shadow-lg">

            <!-- Header con gradiente -->
            <div class="modal-header modal-header-custom border-0">
                <div class="w-100">
                    <div class="text-center">
                        <h5 class="m-0 font-weight-bold" id="editarCicloLabel{{ $ciclo->id_ciclo }}">
                            ✏️ Editar Ciclo Escolar
                        </h5>
                        <p class="m-0 mt-2 mb-0" style="font-size: 0.9rem; opacity: 0.95;">
                            Modifique la información del ciclo escolar
                        </p>
                    </div>
                </div>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Cerrar" style="position: absolute; right: 1.5rem; top: 1.5rem; font-size: 1.8rem; opacity: 0.9;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('ciclos.update', $ciclo->id_ciclo) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="is_edit_{{ $ciclo->id_ciclo }}" value="1">
                
                <div class="modal-body modal-body-custom p-4">
                    <div class="form-container p-4 bg-white rounded shadow-sm border">
                        
                        <!-- Sección 1: Información Básica -->
                        <div class="card shadow mb-2 border-0">
                            <div class="card-header py-3 text-white card-header-custom">
                                <h6 class="m-0 font-weight-bold text-danger">
                                    <i class="fas fa-info-circle"></i> Información del Ciclo
                                </h6>
                            </div>
                            <div class="card-body1 p-4">
                                <div class="form-group mb-0">
                                    <label class="form-label-custom d-flex">
                                        Nombre del Ciclo Escolar
                                        <span class="required-asterisk ml-1">*</span>
                                    </label>
                                    <small class="form-text text-muted">
                                        Ingrese un nombre descriptivo para el ciclo escolar
                                    </small>
                                    <input type="text" 
                                           placeholder="Ejemplo: 2024-2025" 
                                           name="nombre" 
                                           value="{{ old('nombre', $ciclo->nombre) }}" 
                                           class="form-control form-control-custom @error('nombre') @if(old('is_edit_'.$ciclo->id_ciclo)) is-invalid @endif @enderror" 
                                           required>
                                    @error('nombre')
                                        @if(old('is_edit_'.$ciclo->id_ciclo))
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @endif
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Sección 2: Fechas -->
                        <div class="card shadow mb-2 border-0">
                            <div class="card-header py-3 text-white card-header-custom">
                                <h6 class="m-0 font-weight-bold text-danger">
                                    <i class="fas fa-calendar-alt"></i> Período del Ciclo
                                </h6>
                            </div>
                            <div class="card-body1 p-4">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label-custom d-flex">
                                                Fecha de Inicio
                                                <span class="required-asterisk ml-1">*</span>
                                            </label>
                                            <input type="date" 
                                                   name="fecha_inicio" 
                                                   value="{{ old('fecha_inicio', $ciclo->fecha_inicio) }}" 
                                                   class="form-control form-control-custom @error('fecha_inicio') @if(old('is_edit_'.$ciclo->id_ciclo)) is-invalid @endif @enderror" 
                                                   required>
                                            @error('fecha_inicio')
                                                @if(old('is_edit_'.$ciclo->id_ciclo))
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @endif
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mb-0">
                                            <label class="form-label-custom d-flex">
                                                Fecha de Finalización
                                                <span class="required-asterisk ml-1">*</span>
                                            </label>
                                            <input type="date" 
                                                   name="fecha_fin" 
                                                   value="{{ old('fecha_fin', $ciclo->fecha_fin) }}" 
                                                   class="form-control form-control-custom @error('fecha_fin') @if(old('is_edit_'.$ciclo->id_ciclo)) is-invalid @endif @enderror" 
                                                   required>
                                            @error('fecha_fin')
                                                @if(old('is_edit_'.$ciclo->id_ciclo))
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @endif
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="periodo-info mt-3">
                                    <i class="fas fa-info-circle text-primary"></i>
                                    <strong>Duración actual:</strong> 
                                    {{ \Carbon\Carbon::parse($ciclo->fecha_inicio)->diffInDays($ciclo->fecha_fin) }} días
                                </div>
                            </div>
                        </div>

                        <!-- Sección 3: Estado -->
                        <div class="card shadow mb-4 border-0">
                            <div class="card-header py-3 text-white card-header-custom">
                                <h6 class="m-0 font-weight-bold text-danger">
                                    <i class="fas fa-cog"></i> Configuración del Ciclo
                                </h6>
                            </div>
                            <div class="card-body1 p-4">
                                <div class="form-group mb-0">
                                    <label class="form-label-custom d-flex">
                                        Estado del Ciclo
                                        <span class="required-asterisk ml-1">*</span>
                                    </label>
                                    <select name="estado" 
                                            class="form-control form-control-custom @error('estado') @if(old('is_edit_'.$ciclo->id_ciclo)) is-invalid @endif @enderror" 
                                            required>
                                        <option value="">-- Seleccione el estado del ciclo --</option>
                                        <option value="Activo" {{ old('estado', $ciclo->estado) == 'Activo' ? 'selected' : '' }}>
                                            Activo
                                        </option>
                                        <option value="Inactivo" {{ old('estado', $ciclo->estado) == 'Inactivo' ? 'selected' : '' }}>
                                            Inactivo
                                        </option>
                                    </select>
                                    <small class="text-muted mt-1 d-block">
                                        <i class="fas fa-lightbulb"></i>
                                        Un ciclo activo permite la gestión de períodos y matrículas
                                    </small>
                                    @error('estado')
                                        @if(old('is_edit_'.$ciclo->id_ciclo))
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @endif
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Nota de campos obligatorios -->
                        <div class="text-center mt-3">
                            <small class="text-muted">
                                <span class="required-asterisk">*</span> Campos obligatorios
                            </small>
                        </div>

                    </div>
                </div>

                <div class="modal-footer modal-footer-custom border-top">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times mr-2"></i>
                        Cancelar
                    </button>
                    <button type="submit" class="btn btn-warning text-white">
                        <i class="fas fa-save mr-2"></i>
                        Actualizar Ciclo
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

                                            <!-- Delete Modal -->
                                            <div class="modal fade" id="deleteModal{{ $ciclo->id_ciclo }}"
                                                tabindex="-1" role="dialog">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header1 modal-header-custom border-0">
                                                            <div class="w-100 text-center">
                                                            <h5 class="m-0 font-weight-bold">
                                                                🗑️ Eliminar Ciclo Escolar
                                                            </h5>
                                                            </div>
                                                            <button type="button" class="close text-white"
                                                                data-dismiss="modal">
                                                                <span>&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body text-center">
                                                            
                                                            <h6 class="mt-3">¿Está seguro de eliminar el ciclo
                                                                escolar?</h6>
                                                            <p class="text-muted">
                                                                <strong>{{ $ciclo->nombre }}</strong></p>
                                                            
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Cancelar</button>
                                                            <form
                                                                action="{{ route('ciclos.destroy', $ciclo->id_ciclo) }}"
                                                                method="POST" style="display: inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger">
                                                                    <i class="fas fa-trash"></i> Eliminar
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center text-muted">
                                                    <i class="fas fa-inbox fa-3x mb-3"></i>
                                                    <p>No hay ciclos escolares registrados</p>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
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

    <!-- Create Modal -->
   <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="nuevoCicloLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content border-0 shadow-lg">

            <!-- Header con gradiente -->
            <div class="modal-header modal-header-custom border-0">
                <div class="w-100">
                    <div class="text-center">
                        <h5 class="m-0 font-weight-bold" id="nuevoCicloLabel">
                            📅 Nuevo Ciclo Escolar
                        </h5>
                        <p class="m-0 mt-2 mb-0" style="font-size: 0.9rem; opacity: 0.95;">
                            Complete la información del ciclo escolar
                        </p>
                    </div>
                </div>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Cerrar" style="position: absolute; right: 1.5rem; top: 1.5rem; font-size: 1.8rem; opacity: 0.9;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('ciclos.store') }}" method="POST">
                @csrf
                <input type="hidden" name="is_create" value="1">
                
                <div class="modal-body modal-body-custom p-4">
                    <div class="form-container p-4 bg-white rounded shadow-sm border">
                        
                        <!-- Sección 1: Información Básica -->
                        <div class="card shadow mb-2 border-0">
                            <div class="card-header py-3 text-white card-header-custom">
                                <h6 class="m-0 font-weight-bold text-danger">
                                    <i class="fas fa-info-circle"></i> Información del Ciclo
                                </h6>
                            </div>
                            <div class="card-body1 p-4">
                                <div class="form-group mb-0">
                                    <label class="form-label-custom d-flex">
                                        Nombre del Ciclo Escolar
                                        <span class="required-asterisk ml-1">*</span>
                                    </label>
                                    <small class="form-text text-muted">
                                        Ingrese un nombre descriptivo para el ciclo escolar
                                    </small>
                                    <input type="text" 
                                           placeholder="Ejemplo: 2024-2025" 
                                           name="nombre" 
                                           value="{{ old('nombre') }}" 
                                           class="form-control form-control-custom @error('nombre') @if(old('is_create')) is-invalid @endif @enderror" 
                                           required>
                                    @error('nombre')
                                        @if(old('is_create'))
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @endif
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Sección 2: Fechas -->
                        <div class="card shadow mb-2 border-0">
                            <div class="card-header py-3 text-white card-header-custom">
                                <h6 class="m-0 font-weight-bold text-danger">
                                    <i class="fas fa-calendar-alt"></i> Período del Ciclo
                                </h6>
                            </div>
                            <div class="card-body1 p-4">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label-custom d-flex">
                                                Fecha de Inicio
                                                <span class="required-asterisk ml-1">*</span>
                                            </label>
                                            <input type="date" 
                                                   name="fecha_inicio" 
                                                   value="{{ old('fecha_inicio') }}" 
                                                   class="form-control form-control-custom @error('fecha_inicio') @if(old('is_create')) is-invalid @endif @enderror" 
                                                   required>
                                            @error('fecha_inicio')
                                                @if(old('is_create'))
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @endif
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mb-0">
                                            <label class="form-label-custom d-flex">
                                                Fecha de Finalización
                                                <span class="required-asterisk ml-1">*</span>
                                            </label>
                                            <input type="date" 
                                                   name="fecha_fin" 
                                                   value="{{ old('fecha_fin') }}" 
                                                   class="form-control form-control-custom @error('fecha_fin') @if(old('is_create')) is-invalid @endif @enderror" 
                                                   required>
                                            @error('fecha_fin')
                                                @if(old('is_create'))
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @endif
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="periodo-info mt-3">
                                    <i class="fas fa-info-circle text-primary"></i>
                                    <strong>Nota:</strong> La fecha de fin debe ser posterior a la fecha de inicio.
                                </div>
                            </div>
                        </div>

                        <!-- Sección 3: Estado -->
                        <div class="card shadow mb-4 border-0">
                            <div class="card-header py-3 text-white card-header-custom">
                                <h6 class="m-0 font-weight-bold text-danger">
                                    <i class="fas fa-cog"></i> Configuración del Ciclo
                                </h6>
                            </div>
                            <div class="card-body1 p-4">
                                <div class="form-group mb-0">
                                    <label class="form-label-custom d-flex">
                                        Estado del Ciclo
                                        <span class="required-asterisk ml-1">*</span>
                                    </label>
                                    <select name="estado" 
                                            class="form-control form-control-custom @error('estado') @if(old('is_create')) is-invalid @endif @enderror" 
                                            required>
                                        <option value="">-- Seleccione el estado del ciclo --</option>
                                        <option value="Activo" {{ old('estado') == 'Activo' ? 'selected' : '' }}>
                                            Activo
                                        </option>
                                        <option value="Inactivo" {{ old('estado') == 'Inactivo' ? 'selected' : '' }}>
                                            Inactivo
                                        </option>
                                    </select>
                                    <small class="text-muted mt-1 d-block">
                                        <i class="fas fa-lightbulb"></i>
                                        Un ciclo activo permite la gestión de períodos y matrículas
                                    </small>
                                    @error('estado')
                                        @if(old('is_create'))
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @endif
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Nota de campos obligatorios -->
                        <div class="text-center mt-3">
                            <small class="text-muted">
                                <span class="required-asterisk">*</span> Campos obligatorios
                            </small>
                        </div>

                    </div>
                </div>

                <div class="modal-footer modal-footer-custom border-top">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times mr-2"></i>
                        Cancelar
                    </button>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save mr-2"></i>
                        Guardar Ciclo
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

    <!-- Scripts -->
    <script src="{{ asset('libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('libs/sbadmin/js/sb-admin-2.min.js') }}"></script>

    @if ($errors->any())
        <script>
            $(document).ready(function() {
                $('#createModal').modal('show');
            });
        </script>
    @endif

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
