<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Coordinador</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Custom fonts for this template-->
    <link href="{{ asset('libs/fontawesome/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link rel ="icon" type="image/png" href="{{ asset('libs/sbadmin/img/up_logo.png') }}">
    <!-- Custom styles for this template-->
    <link href="{{ asset('libs/sbadmin/css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>
<body id="page-top">
    <!-- Top Header -->
     <div class="bg-danger1 text-white1 text-center py-2">
        <div class="d-flex justify-content-between align-items-center px-4">

            <h4 class="mb-0" style="text-align: center;">SISTEMA DE CONTROL ESCOLAR</h4>

        </div>
    </div>
    <nav class="bg-blue-600 text-white p-4">
        <div class="container mx-auto flex justify-between">
            <h1 class="text-xl font-bold">Panel de Coordinador</h1>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="bg-red-500 px-4 py-2 rounded">Cerrar Sesión</button>
            </form>
        </div>
    </nav>
    <div class="container mx-auto mt-8 p-4">
        <h2 class="text-2xl mb-4">Bienvenido Coordinador</h2>
        <p>Usuario: {{ auth()->user()->username }}</p>
        <p>Nivel: {{ auth()->user()->getNivel() }}</p>
    </div>

     <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('libs/sbadmin/js/sb-admin-2.min.js') }}"></script>
</body>
</html>