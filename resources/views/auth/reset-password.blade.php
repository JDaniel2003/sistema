<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Restablecer contraseña</title>
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
        .error { color: yellow; }
    </style>
</head>
<body>
   <form method="POST" action="{{ route('password.update') }}">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">
    
    <!-- Usa username en lugar de email -->
    
    <input type="hidden" name="username" value="{{ session('reset_username', '') }}" required>

    <label>Nueva contraseña:</label>
    <input type="password" name="password" required minlength="8">

    <label>Confirmar contraseña:</label>
    <input type="password" name="password_confirmation" required>

    <button type="submit">Cambiar contraseña</button>
</form>
</body>
</html>