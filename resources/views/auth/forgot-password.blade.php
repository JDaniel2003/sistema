<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Recuperar contraseña</title>
    <style>
        body {
            background: #8A1010;
            font-family: Nunito, sans-serif;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        form {
            background: rgba(255,255,255,0.15);
            padding: 40px;
            border-radius: 20px;
            width: 350px;
        }
        input {
            width: 100%;
            padding: 10px;
            border-radius: 10px;
            margin: 8px 0;
            box-sizing: border-box;
        }
        button {
            width: 100%;
            padding: 10px;
            background: #5B8736;
            color: white;
            border: none;
            border-radius: 10px;
            margin-top: 15px;
            cursor: pointer;
        }
        a {
            color: white;
            text-decoration: none;
            display: block;
            text-align: center;
            margin-top: 15px;
        }
        .error { color: yellow; }
        .success { color: #00ff00; text-align: center; margin: 10px 0; }
    </style>
</head>
<body>
    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <h2 style="text-align:center; margin-bottom:20px;">Recuperar contraseña</h2>

        @if (session('status'))
            <p class="success">{{ session('status') }}</p>
        @endif

        <label>Correo electrónico:</label>
        <input type="email" name="email" value="{{ old('email') }}" required>

        <label>Nombre de usuario:</label>
        <input type="text" name="username" value="{{ old('username') }}" required>

        @error('email')
            <p class="error">{{ $message }}</p>
        @enderror
        @error('username')
            <p class="error">{{ $message }}</p>
        @enderror

        <button type="submit">Enviar enlace</button>
        <a href="{{ route('login') }}">Volver al login</a>
    </form>
</body>
</html>