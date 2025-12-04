<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Directivos</title>

    <link href="{{ asset('libs/fontawesome/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('libs/sbadmin/img/up_logo.png') }}">
    <link href="{{ asset('libs/sbadmin/css/sb-admin-2.min.css') }}" rel="stylesheet">
    
    <style>
    /* Estilos personalizados */
    .modal-header-custom {
        background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        color: white;
        padding: 2rem;
    }

    .modal-body-custom {
        background: #f8f9fc;
    }

    .modal-footer-custom {
        background: #fff;
        padding: 1rem 1.5rem;
    }

    .card-header-custom {
        background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
    }

    .form-label-custom {
        font-weight: 600;
        color: #333;
        font-size: 0.95rem;
        margin-bottom: 0.5rem;
    }

    .form-control-custom {
        border: 2px solid #e3e6f0;
        border-radius: 0.5rem;
        padding: 0.75rem;
        font-size: 0.95rem;
        transition: all 0.3s ease;
    }

    .form-control-custom:focus {
        border-color: #dc3545;
        box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
    }

    .required-asterisk {
        color: #dc3545;
        font-weight: bold;
    }

    .card-body1 {
        background: #ffffff;
    }

    .btn-success {
        background: linear-gradient(135deg, #1cc88a 0%, #17a673 100%);
        border: none;
        padding: 0.6rem 1.5rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-success:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(28, 200, 138, 0.4);
    }

    .btn-info {
        background: linear-gradient(135deg, #36b9cc 0%, #2c9faf 100%);
        border: none;
        transition: all 0.3s ease;
    }

    .btn-info:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(54, 185, 204, 0.4);
    }
    </style>
</head>

<body id="page-top">
    <!-- Top Header -->
    <div class="bg-danger text-white1 text-center py-2">
        <h4 class="mb-0">SISTEMA DE CONTROL ESCOLAR</h4>
    </div>

    <!-- Logout Modal -->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <div class="w-100 text-center">
                        <h5 class="m-0 font-weight-bold" id="logoutModalLabel">
                            <i class="fas fa-sign-out-alt mr-2"></i>
                            Cerrar Sesión
                        </h5>
                    </div>
                    <button class="close text-white" type="button" data-dismiss="modal" aria-label="Close" style="position: absolute; right: 1rem; top: 1rem; opacity: 0.9;">
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
        <div class="d-flex align-items-center">
            <div style="width: 300px; height: 120px;">
                <img src="{{ asset('libs/sbadmin/img/upn.png') }}" alt="Logo" style="width: 100%; height: 100%; object-fit: cover;">
            </div>
        </div>

        <div class="collapse navbar-collapse ml-4">
            <ul class="navbar-nav" style="padding-left: 20%;">
                <li class="nav-item"><a class="nav-link text-white px-3 mr-1" href="{{ route('admin') }}">Inicio</a></li>
                <li class="nav-item"><a class="nav-link navbar-active-item px-3 mr-1">Directivos</a></li>
                <li class="nav-item"><a class="nav-link text-white px-3 mr-1" href="{{ route('carreras.index') }}">Carreras</a></li>
                <li class="nav-item"><a class="nav-link text-white px-3 mr-1" href="{{ route('materias.index') }}">Materias</a></li>
                <li class="nav-item"><a class="nav-link text-white px-3 mr-1" href="{{ route('alumnos.index') }}">Alumnos</a></li>
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
                <!-- Main Content -->
                <div class="container-fluid py-4">
                    <h1 class="text-danger text-center mb-5" style="font-size: 2.5rem; font-weight: bold; font-family: 'Arial Black', Verdana, sans-serif;">
                        Gestión de Directivos
                    </h1>
                    
                    <div class="row justify-content-center">
                        <div class="col-lg-11">
                            <div class="mb-3 text-right">
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#createModal">
                                    <i class="fas fa-plus"></i> Nuevo Directivo
                                </button>
                            </div>

                            <!-- Filters -->
                            <div class="container mb-4 d-flex justify-content-center">
                                <div class="p-3 border rounded bg-light d-inline-block shadow-sm">
                                    <form method="GET" action="{{ route('directivos.index') }}" class="d-flex flex-wrap gap-2 align-items-center">
                                        <div style="width: 500px;">
                                            <input type="text" id="searchInput" class="form-control form-control-sm" placeholder="🔍 Buscar por nombre, cargo o correo">
                                        </div>
                                        <select name="mostrar" onchange="this.form.submit()" class="form-control form-control-sm w-auto">
                                            <option value="10" {{ request('mostrar') == 10 ? 'selected' : '' }}>10</option>
                                            <option value="13" {{ request('mostrar') == 13 ? 'selected' : '' }}>13</option>
                                            <option value="25" {{ request('mostrar') == 25 ? 'selected' : '' }}>25</option>
                                            <option value="50" {{ request('mostrar') == 50 ? 'selected' : '' }}>50</option>
                                            <option value="todo" {{ request('mostrar') == 'todo' ? 'selected' : '' }}>Todo</option>
                                        </select>
                                        <a href="{{ route('directivos.index', ['mostrar' => 'todo']) }}" class="btn btn-sm btn-outline-secondary d-flex align-items-center">
                                            <i class="fas fa-list me-1"></i> Mostrar todo
                                        </a>
                                    </form>
                                </div>
                            </div>

                            <!-- Alerts -->
                            @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fas fa-check-circle"></i> {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif

                            @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif

                            <!-- Table -->
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover text-center" id="directivosTable" width="100%">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Nombre Completo</th>
                                            <th>Correo</th>
                                            <th>Cargo</th>
                                            <th>Abreviatura</th>
                                            <th>Usuario</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($directivos as $directivo)
                                        <tr>
                                            <td><strong>{{ $directivo->nombre_completo }}</strong></td>
                                            <td>{{ $directivo->correo }}</td>
                                            <td>{{ $directivo->cargo }}</td>
                                            <td>
                                                @if($directivo->abreviatura)
                                                    <span class="badge badge-info">{{ $directivo->abreviatura->abreviatura }}</span>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($directivo->usuario)
                                                    <span class="badge badge-success">{{ $directivo->usuario->username }}</span>
                                                @else
                                                    <span class="text-muted">Sin usuario</span>
                                                @endif
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-info" onclick="verDirectivo({{ $directivo->id_directivo }})">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editModal{{ $directivo->id_directivo }}">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal{{ $directivo->id_directivo }}">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="6" class="text-center text-muted">
                                                <i class="fas fa-inbox fa-3x mb-3"></i>
                                                <p>No hay directivos registrados</p>
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

    <!-- Modal Crear Directivo -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="nuevoDirectivoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header modal-header-custom border-0">
                <div class="w-100">
                    <div class="text-center">
                        <h5 class="m-0 font-weight-bold" id="nuevoDirectivoLabel">
                            👤 Nuevo Directivo
                        </h5>
                        <p class="m-0 mt-2 mb-0" style="font-size: 0.9rem; opacity: 0.95;">
                            Complete la información del directivo
                        </p>
                    </div>
                </div>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Cerrar" style="position: absolute; right: 1.5rem; top: 1.5rem; font-size: 1.8rem; opacity: 0.9;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('directivos.store') }}" method="POST">
                @csrf
                <input type="hidden" name="is_create" value="1">
                
                <div class="modal-body modal-body-custom p-4">
                    <div class="form-container p-4 bg-white rounded shadow-sm border">
                        
                        <!-- Sección 1: Información Personal -->
                        <div class="card shadow mb-2 border-0">
                            <div class="card-header py-3 text-white card-header-custom">
                                <h6 class="m-0 font-weight-bold text-danger">
                                    <i class="fas fa-user"></i> Información Personal
                                </h6>
                            </div>
                            <div class="card-body1 p-4">
                                <div class="form-group mb-3">
                                    <label class="form-label-custom d-flex">
                                        Nombres
                                        <span class="required-asterisk ml-1">*</span>
                                    </label>
                                    <input type="text" 
                                           placeholder="Ingrese los nombres" 
                                           name="nombres" 
                                           value="{{ old('nombres') }}" 
                                           class="form-control form-control-custom @error('nombres') @if(old('is_create')) is-invalid @endif @enderror" 
                                           required>
                                    @error('nombres')
                                        @if(old('is_create'))
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @endif
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label-custom d-flex">
                                                Primer Apellido
                                                <span class="required-asterisk ml-1">*</span>
                                            </label>
                                            <input type="text" 
                                                   placeholder="Primer apellido" 
                                                   name="primer_apellido" 
                                                   value="{{ old('primer_apellido') }}" 
                                                   class="form-control form-control-custom @error('primer_apellido') @if(old('is_create')) is-invalid @endif @enderror" 
                                                   required>
                                            @error('primer_apellido')
                                                @if(old('is_create'))
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @endif
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mb-0">
                                            <label class="form-label-custom d-flex">
                                                Segundo Apellido
                                            </label>
                                            <input type="text" 
                                                   placeholder="Segundo apellido (opcional)" 
                                                   name="segundo_apellido" 
                                                   value="{{ old('segundo_apellido') }}" 
                                                   class="form-control form-control-custom @error('segundo_apellido') @if(old('is_create')) is-invalid @endif @enderror">
                                            @error('segundo_apellido')
                                                @if(old('is_create'))
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @endif
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Sección 2: Información de Contacto -->
                        <div class="card shadow mb-2 border-0">
                            <div class="card-header py-3 text-white card-header-custom">
                                <h6 class="m-0 font-weight-bold text-danger">
                                    <i class="fas fa-envelope"></i> Información de Contacto
                                </h6>
                            </div>
                            <div class="card-body1 p-4">
                                <div class="form-group mb-0">
                                    <label class="form-label-custom d-flex">
                                        Correo Electrónico
                                        <span class="required-asterisk ml-1">*</span>
                                    </label>
                                    <input type="email" 
                                           placeholder="ejemplo@upn.mx" 
                                           name="correo" 
                                           value="{{ old('correo') }}" 
                                           class="form-control form-control-custom @error('correo') @if(old('is_create')) is-invalid @endif @enderror" 
                                           required>
                                    @error('correo')
                                        @if(old('is_create'))
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @endif
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Sección 3: Información Institucional -->
                        <div class="card shadow mb-2 border-0">
                            <div class="card-header py-3 text-white card-header-custom">
                                <h6 class="m-0 font-weight-bold text-danger">
                                    <i class="fas fa-briefcase"></i> Información Institucional
                                </h6>
                            </div>
                            <div class="card-body1 p-4">
                                <div class="form-group mb-3">
                                    <label class="form-label-custom d-flex">
                                        Cargo
                                        <span class="required-asterisk ml-1">*</span>
                                    </label>
                                    <input type="text" 
                                           placeholder="Ej: Director Académico" 
                                           name="cargo" 
                                           value="{{ old('cargo') }}" 
                                           class="form-control form-control-custom @error('cargo') @if(old('is_create')) is-invalid @endif @enderror" 
                                           required>
                                    @error('cargo')
                                        @if(old('is_create'))
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @endif
                                    @enderror
                                </div>

                                <div class="form-group mb-0">
                                    <label class="form-label-custom d-flex">
                                        Abreviatura
                                    </label>
                                    <select name="id_abreviatura" 
                                            class="form-control form-control-custom @error('id_abreviatura') @if(old('is_create')) is-invalid @endif @enderror">
                                        <option value="">-- Seleccione una abreviatura --</option>
                                        @foreach($abreviaturas as $abreviatura)
                                            <option value="{{ $abreviatura->id_abreviatura }}" {{ old('id_abreviatura') == $abreviatura->id_abreviatura ? 'selected' : '' }}>
                                                {{ $abreviatura->abreviatura }} - {{ $abreviatura->descripcion }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('id_abreviatura')
                                        @if(old('is_create'))
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @endif
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Sección 4: Datos de Acceso al Sistema -->
                        <div class="card shadow mb-4 border-0">
                            <div class="card-header py-3 text-white card-header-custom">
                                <h6 class="m-0 font-weight-bold text-danger">
                                    <i class="fas fa-key"></i> Datos de Acceso al Sistema
                                </h6>
                            </div>
                            <div class="card-body1 p-4">
                                <div class="custom-control custom-checkbox mb-3">
                                    <input type="checkbox" class="custom-control-input" id="crearUsuarioCheckbox" name="crear_usuario" value="1" {{ old('crear_usuario') ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="crearUsuarioCheckbox">
                                        <strong>Crear usuario de acceso al sistema</strong>
                                        <small class="d-block text-muted">Marque esta opción si desea crear credenciales de acceso</small>
                                    </label>
                                </div>

                                <div id="camposUsuario" style="display: {{ old('crear_usuario') ? 'block' : 'none' }};">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label class="form-label-custom d-flex">
                                                    Nombre de Usuario
                                                    <span class="required-asterisk ml-1" id="asterisco-username">*</span>
                                                </label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-user"></i>
                                                        </span>
                                                    </div>
                                                    <input type="text" 
                                                           placeholder="usuario.directivo" 
                                                           name="username" 
                                                           id="username"
                                                           value="{{ old('username') }}" 
                                                           class="form-control form-control-custom @error('username') @if(old('is_create')) is-invalid @endif @enderror">
                                                </div>
                                                <small class="text-muted">
                                                    <i class="fas fa-info-circle"></i>
                                                    Solo letras, números, puntos y guiones bajos
                                                </small>
                                                @error('username')
                                                    @if(old('is_create'))
                                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                                    @endif
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label class="form-label-custom d-flex">
                                                    Rol del Usuario
                                                    <span class="required-asterisk ml-1" id="asterisco-rol">*</span>
                                                </label>
                                                <select name="id_rol" 
                                                        id="id_rol"
                                                        class="form-control form-control-custom @error('id_rol') @if(old('is_create')) is-invalid @endif @enderror">
                                                    <option value="">-- Seleccione un rol --</option>
                                                    @foreach($roles as $rol)
                                                        <option value="{{ $rol->id_rol }}" {{ old('id_rol') == $rol->id_rol ? 'selected' : '' }}>
                                                            {{ $rol->nombre }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('id_rol')
                                                    @if(old('is_create'))
                                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                                    @endif
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label class="form-label-custom d-flex">
                                                    Contraseña
                                                    <span class="required-asterisk ml-1" id="asterisco-password">*</span>
                                                </label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-lock"></i>
                                                        </span>
                                                    </div>
                                                    <input type="password" 
                                                           placeholder="Mínimo 8 caracteres" 
                                                           name="password" 
                                                           id="password"
                                                           class="form-control form-control-custom @error('password') @if(old('is_create')) is-invalid @endif @enderror">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                                            <i class="fas fa-eye" id="iconPassword"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <small class="text-muted">
                                                    <i class="fas fa-shield-alt"></i>
                                                    Mínimo 8 caracteres, incluya mayúsculas, números y símbolos
                                                </small>
                                                @error('password')
                                                    @if(old('is_create'))
                                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                                    @endif
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group mb-0">
                                                <label class="form-label-custom d-flex">
                                                    Confirmar Contraseña
                                                    <span class="required-asterisk ml-1" id="asterisco-password-confirm">*</span>
                                                </label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-lock"></i>
                                                        </span>
                                                    </div>
                                                    <input type="password" 
                                                           placeholder="Repita la contraseña" 
                                                           name="password_confirmation" 
                                                           id="password_confirmation"
                                                           class="form-control form-control-custom @error('password_confirmation') @if(old('is_create')) is-invalid @endif @enderror">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-outline-secondary" type="button" id="togglePasswordConfirm">
                                                            <i class="fas fa-eye" id="iconPasswordConfirm"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                @error('password_confirmation')
                                                    @if(old('is_create'))
                                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                                    @endif
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Indicador de fortaleza de contraseña -->
                                    <div class="mt-3" id="passwordStrength" style="display: none;">
                                        <label class="form-label-custom">Fortaleza de la contraseña:</label>
                                        <div class="progress" style="height: 8px;">
                                            <div id="passwordStrengthBar" class="progress-bar" role="progressbar" style="width: 0%"></div>
                                        </div>
                                        <small id="passwordStrengthText" class="text-muted"></small>
                                    </div>
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
                        Guardar Directivo
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Mostrar/ocultar campos de usuario
    $('#crearUsuarioCheckbox').change(function() {
        if ($(this).is(':checked')) {
            $('#camposUsuario').slideDown();
            // Hacer campos requeridos
            $('#username, #password, #password_confirmation, #id_rol').attr('required', true);
            $('#asterisco-username, #asterisco-password, #asterisco-password-confirm, #asterisco-rol').show();
        } else {
            $('#camposUsuario').slideUp();
            // Quitar requeridos
            $('#username, #password, #password_confirmation, #id_rol').attr('required', false);
            $('#asterisco-username, #asterisco-password, #asterisco-password-confirm, #asterisco-rol').hide();
        }
    });

    // Toggle mostrar/ocultar contraseña
    $('#togglePassword').click(function() {
        const passwordField = $('#password');
        const icon = $('#iconPassword');
        
        if (passwordField.attr('type') === 'password') {
            passwordField.attr('type', 'text');
            icon.removeClass('fa-eye').addClass('fa-eye-slash');
        } else {
            passwordField.attr('type', 'password');
            icon.removeClass('fa-eye-slash').addClass('fa-eye');
        }
    });

    $('#togglePasswordConfirm').click(function() {
        const passwordField = $('#password_confirmation');
        const icon = $('#iconPasswordConfirm');
        
        if (passwordField.attr('type') === 'password') {
            passwordField.attr('type', 'text');
            icon.removeClass('fa-eye').addClass('fa-eye-slash');
        } else {
            passwordField.attr('type', 'password');
            icon.removeClass('fa-eye-slash').addClass('fa-eye');
        }
    });

    // Validar fortaleza de contraseña
    $('#password').on('input', function() {
        const password = $(this).val();
        const strengthBar = $('#passwordStrengthBar');
        const strengthText = $('#passwordStrengthText');
        const strengthContainer = $('#passwordStrength');

        if (password.length === 0) {
            strengthContainer.hide();
            return;
        }

        strengthContainer.show();

        let strength = 0;
        let strengthLabel = '';
        let strengthColor = '';

        // Calcular fortaleza
        if (password.length >= 8) strength += 25;
        if (password.length >= 12) strength += 25;
        if (/[a-z]/.test(password) && /[A-Z]/.test(password)) strength += 25;
        if (/[0-9]/.test(password)) strength += 15;
        if (/[^a-zA-Z0-9]/.test(password)) strength += 10;

        // Determinar etiqueta y color
        if (strength < 40) {
            strengthLabel = 'Débil';
            strengthColor = 'bg-danger';
        } else if (strength < 70) {
            strengthLabel = 'Media';
            strengthColor = 'bg-warning';
        } else if (strength < 90) {
            strengthLabel = 'Buena';
            strengthColor = 'bg-info';
        } else {
            strengthLabel = 'Excelente';
            strengthColor = 'bg-success';
        }

        strengthBar.css('width', strength + '%')
                   .removeClass('bg-danger bg-warning bg-info bg-success')
                   .addClass(strengthColor);
        strengthText.text(strengthLabel);
    });

    // Validar coincidencia de contraseñas
    $('#password_confirmation').on('input', function() {
        const password = $('#password').val();
        const passwordConfirm = $(this).val();

        if (passwordConfirm.length > 0) {
            if (password === passwordConfirm) {
                $(this).removeClass('is-invalid').addClass('is-valid');
            } else {
                $(this).removeClass('is-valid').addClass('is-invalid');
            }
        } else {
            $(this).removeClass('is-valid is-invalid');
        }
    });

    // Auto-generar username basado en nombres y apellidos
    $('#nombres, #primer_apellido').on('blur', function() {
        const nombres = $('#nombres').val();
        const apellido = $('#primer_apellido').val();
        const usernameField = $('#username');

        if (nombres && apellido && !usernameField.val()) {
            const primerNombre = nombres.split(' ')[0].toLowerCase();
            const primerApellido = apellido.toLowerCase();
            const username = primerNombre + '.' + primerApellido;
            
            usernameField.val(username.normalize("NFD").replace(/[\u0300-\u036f]/g, ""));
        }
    });
});
</script>

<!-- Modal Ver Directivo -->
<div class="modal fade" id="verModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title">
                    <i class="fas fa-eye mr-2"></i>
                    Detalles del Directivo
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body p-4">
                <div class="card mb-3">
                    <div class="card-header bg-light">
                        <strong><i class="fas fa-user"></i> Información Personal</strong>
                    </div>
                    <div class="card-body">
                        <p><strong>Nombre Completo:</strong> <span id="verNombreCompleto"></span></p>
                        <p><strong>Correo:</strong> <span id="verCorreo"></span></p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-light">
                        <strong><i class="fas fa-briefcase"></i> Información Institucional</strong>
                    </div>
                    <div class="card-body">
                        <p><strong>Cargo:</strong> <span id="verCargo"></span></p>
                        <p><strong>Abreviatura:</strong> <span id="verAbreviatura"></span></p>
                        <p><strong>Usuario del Sistema:</strong> <span id="verUsuario"></span></p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times mr-2"></i>
                    Cerrar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modales Editar -->
@foreach($directivos as $directivo)
<div class="modal fade" id="editModal{{ $directivo->id_directivo }}" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header modal-header-custom border-0">
                <div class="w-100">
                    <div class="text-center">
                        <h5 class="m-0 font-weight-bold">
                            ✏️ Editar Directivo
                        </h5>
                        <p class="m-0 mt-2 mb-0" style="font-size: 0.9rem; opacity: 0.95;">
                            Modifique la información del directivo
                        </p>
                    </div>
                </div>
                <button type="button" class="close text-white" data-dismiss="modal" style="position: absolute; right: 1.5rem; top: 1.5rem; font-size: 1.8rem; opacity: 0.9;">
                    <span>&times;</span>
                </button>
            </div>

            <form action="{{ route('directivos.update', $directivo->id_directivo) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="is_edit_{{ $directivo->id_directivo }}" value="1">
                
                <div class="modal-body modal-body-custom p-4">
                    <div class="form-container p-4 bg-white rounded shadow-sm border">
                        
                        <!-- Información Personal -->
                        <div class="card shadow mb-2 border-0">
                            <div class="card-header py-3 text-white card-header-custom">
                                <h6 class="m-0 font-weight-bold text-danger">
                                    <i class="fas fa-user"></i> Información Personal
                                </h6>
                            </div>
                            <div class="card-body1 p-4">
                                <div class="form-group mb-3">
                                    <label class="form-label-custom d-flex">
                                        Nombres
                                        <span class="required-asterisk ml-1">*</span>
                                    </label>
                                    <input type="text" 
                                           name="nombres" 
                                           value="{{ old('nombres', $directivo->nombres) }}" 
                                           class="form-control form-control-custom @error('nombres') @if(old('is_edit_'.$directivo->id_directivo)) is-invalid @endif @enderror" 
                                           required>
                                    @error('nombres')
                                        @if(old('is_edit_'.$directivo->id_directivo))
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @endif
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label-custom d-flex">
                                                Primer Apellido
                                                <span class="required-asterisk ml-1">*</span>
                                            </label>
                                            <input type="text" 
                                                   name="primer_apellido" 
                                                   value="{{ old('primer_apellido', $directivo->primer_apellido) }}" 
                                                   class="form-control form-control-custom" 
                                                   required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mb-0">
                                            <label class="form-label-custom d-flex">
                                                Segundo Apellido
                                            </label>
                                            <input type="text" 
                                                   name="segundo_apellido" 
                                                   value="{{ old('segundo_apellido', $directivo->segundo_apellido) }}" 
                                                   class="form-control form-control-custom">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Información de Contacto -->
                        <div class="card shadow mb-2 border-0">
                            <div class="card-header py-3 text-white card-header-custom">
                                <h6 class="m-0 font-weight-bold text-danger">
                                    <i class="fas fa-envelope"></i> Información de Contacto
                                </h6>
                            </div>
                            <div class="card-body1 p-4">
                                <div class="form-group mb-0">
                                    <label class="form-label-custom d-flex">
                                        Correo Electrónico
                                        <span class="required-asterisk ml-1">*</span>
                                    </label>
                                    <input type="email" 
                                           name="correo" 
                                           value="{{ old('correo', $directivo->correo) }}" 
                                           class="form-control form-control-custom @error('correo') @if(old('is_edit_'.$directivo->id_directivo)) is-invalid @endif @enderror" 
                                           required>
                                    @error('correo')
                                        @if(old('is_edit_'.$directivo->id_directivo))
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @endif
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Información Institucional -->
                        <div class="card shadow mb-4 border-0">
                            <div class="card-header py-3 text-white card-header-custom">
                                <h6 class="m-0 font-weight-bold text-danger">
                                    <i class="fas fa-briefcase"></i> Información Institucional
                                </h6>
                            </div>
                            <div class="card-body1 p-4">
                                <div class="form-group mb-3">
                                    <label class="form-label-custom d-flex">
                                        Cargo
                                        <span class="required-asterisk ml-1">*</span>
                                    </label>
                                    <input type="text" 
                                           name="cargo" 
                                           value="{{ old('cargo', $directivo->cargo) }}" 
                                           class="form-control form-control-custom" 
                                           required>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-0">
                                            <label class="form-label-custom">Abreviatura</label>
                                            <select name="id_abreviatura" class="form-control form-control-custom">
                                                <option value="">-- Seleccione --</option>
                                                @foreach($abreviaturas as $abreviatura)
                                                    <option value="{{ $abreviatura->id_abreviatura }}" 
                                                            {{ old('id_abreviatura', $directivo->id_abreviatura) == $abreviatura->id_abreviatura ? 'selected' : '' }}>
                                                        {{ $abreviatura->abreviatura }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mb-0">
                                            <label class="form-label-custom">Usuario del Sistema</label>
                                            <select name="id_usuario" class="form-control form-control-custom">
                                                <option value="">-- Sin usuario --</option>
                                                @foreach($usuarios as $usuario)
                                                    <option value="{{ $usuario->id_usuario }}" 
                                                            {{ old('id_usuario', $directivo->id_usuario) == $usuario->id_usuario ? 'selected' : '' }}>
                                                        {{ $usuario->name }}
                                                    </option>
                                                @endforeach
                                                @if($directivo->usuario && !$usuarios->contains('id_usuario', $directivo->id_usuario))
                                                    <option value="{{ $directivo->id_usuario }}" selected>
                                                        {{ $directivo->usuario->name }}
                                                    </option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

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
                        Actualizar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Eliminar -->
<div class="modal fade" id="deleteModal{{ $directivo->id_directivo }}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">
                    <i class="fas fa-trash"></i> Eliminar Directivo
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <i class="fas fa-exclamation-triangle text-warning" style="font-size: 4rem;"></i>
                <h6 class="mt-3">¿Está seguro de eliminar este directivo?</h6>
                <p class="text-muted"><strong>{{ $directivo->nombre_completo }}</strong></p>
                <p class="text-muted">{{ $directivo->cargo }}</p>
                <p class="text-danger">Esta acción no se puede deshacer.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <form action="{{ route('directivos.destroy', $directivo->id_directivo) }}" method="POST" style="display: inline;">
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
@endforeach

  

    <!-- Scripts -->
    <script src="{{ asset('libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('libs/sbadmin/js/sb-admin-2.min.js') }}"></script>

    <script>
    // Búsqueda en tabla
    const searchInput = document.getElementById('searchInput');
    if (searchInput) {
        searchInput.addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase().replace(/\s+/g, ' ').trim();
            const table = document.getElementById('directivosTable');
            const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');

            for (let row of rows) {
                const text = row.textContent.toLowerCase().replace(/\s+/g, ' ').trim();
                row.style.display = text.includes(searchTerm) ? '' : 'none';
            }
        });
    }

    // Ver detalles del directivo
    function verDirectivo(id) {
        fetch(`/directivos/${id}`)
            .then(response => response.json())
            .then(data => {
                $('#verModal').modal('show');
                $('#verNombreCompleto').text(data.nombres + ' ' + data.primer_apellido + (data.segundo_apellido ? ' ' + data.segundo_apellido : ''));
                $('#verCorreo').text(data.correo);
                $('#verCargo').text(data.cargo);
                $('#verAbreviatura').text(data.abreviatura ? data.abreviatura.abreviatura : 'No asignada');
                $('#verUsuario').text(data.usuario ? data.usuario.name : 'Sin usuario');
            })
            .catch(error => console.error('Error:', error));
    }

    // Reabrir modales si hay errores
    @if($errors->any() && old('is_create'))
        $('#createModal').modal('show');
    @endif

    @foreach($directivos as $directivo)
        @if($errors->any() && old('is_edit_'.$directivo->id_directivo))
            $('#editModal{{ $directivo->id_directivo }}').modal('show');
        @endif
    @endforeach
    </script>
</body>

</html>