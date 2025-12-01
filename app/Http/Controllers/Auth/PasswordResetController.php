<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\DatosDocente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PasswordResetController extends Controller
{
    public function showForgotForm()
    {
        return view('auth.forgot-password');
    }

   public function sendResetLink(Request $request)
{
    $request->validate(['email' => 'required|email']);

    $datosDocentes = DatosDocente::with('docente.usuario')
        ->where('correo', $request->email)
        ->first();

    if (!$datosDocentes?->docente?->usuario) {
        return back()->withErrors(['email' => 'No se encontró una cuenta con ese correo.']);
    }

    $usuario = $datosDocentes->docente->usuario;
    $email = $datosDocentes->correo;
    $username = $usuario->username; // ← Guardamos el username

    $token = Str::random(64);
    $hashedToken = hash_hmac('sha256', $token, config('app.key'));

    DB::table('password_reset_tokens')->upsert([
        'email' => $email,
        'token' => $hashedToken,
        'created_at' => Carbon::now(),
    ], ['email']);

    // Guardar username en sesión para usarlo en el formulario
    session(['reset_username' => $username]);

    if (app()->environment('local')) {
        return redirect()->to(url('/reset-password/' . $token));
    }

    return back()->with('status', 'Enlace generado.');
}

    public function showResetForm($token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }

    public function resetPassword(Request $request)
{
    $request->validate([
        'token' => 'required',
        'username' => 'required',          // ← ahora es username
        'password' => 'required|min:8|confirmed',
    ]);

    // Obtener el email asociado al token
    $hashedToken = hash_hmac('sha256', $request->token, config('app.key'));
    $record = DB::table('password_reset_tokens')
        ->where('token', $hashedToken)
        ->first();

    if (!$record) {
        return back()->withErrors(['username' => 'El enlace es inválido.']);
    }

    // Encontrar al usuario por username
    $usuario = \App\Models\Usuario::where('username', $request->username)->first();
    if (!$usuario) {
        return back()->withErrors(['username' => 'Usuario no encontrado.']);
    }

    // Actualizar contraseña
    $usuario->password = Hash::make($request->password);
    $usuario->save(); // ✅ Ahora sí se guarda si 'password' está en $fillable

    // Eliminar token
    DB::table('password_reset_tokens')->where('email', $record->email)->delete();

    return redirect()->route('login')->with('status', 'Contraseña restablecida correctamente.');
}
}