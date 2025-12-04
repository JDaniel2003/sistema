<?php

namespace App\Http\Controllers;

use App\Models\Directivo;
use App\Models\Abreviatura;
use App\Models\User;
use App\Models\Rol;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DirectivosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Directivo::with(['abreviatura', 'usuario']);

        // Filtro por nombre completo
        if ($request->filled('nombre')) {
            $nombre = $request->nombre;
            $query->where(function($q) use ($nombre) {
                $q->where('nombres', 'like', "%{$nombre}%")
                  ->orWhere('primer_apellido', 'like', "%{$nombre}%")
                  ->orWhere('segundo_apellido', 'like', "%{$nombre}%");
            });
        }

        // Filtro por cargo
        if ($request->filled('cargo')) {
            $query->where('cargo', 'like', '%' . $request->cargo . '%');
        }

        // Filtro por correo
        if ($request->filled('correo')) {
            $query->where('correo', 'like', '%' . $request->correo . '%');
        }

        // Paginación
        $perPage = $request->get('mostrar', 10);
        if ($perPage === 'todo') {
            $directivos = $query->orderBy('primer_apellido', 'asc')->get();
        } else {
            $directivos = $query->orderBy('primer_apellido', 'asc')->paginate($perPage);
        }

        // Obtener datos para los selects
        $abreviaturas = Abreviatura::orderBy('abreviatura', 'asc')->get();
        $usuarios = Usuario::whereDoesntHave('directivo')
                       ->orderBy('username', 'asc')
                       ->get();
        $roles = Rol::orderBy('nombre', 'asc')->get();

        return view('directivos.index', compact('directivos', 'abreviaturas', 'usuarios', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación básica del directivo
        $rules = [
            'nombres' => 'required|string|max:100',
            'primer_apellido' => 'required|string|max:100',
            'segundo_apellido' => 'nullable|string|max:100',
            'correo' => 'required|email|max:150|unique:directivos,correo',
            'cargo' => 'required|string|max:100',
            'id_abreviatura' => 'nullable|exists:abreviaturas,id_abreviatura',
        ];

        $messages = [
            'nombres.required' => 'El nombre es obligatorio',
            'primer_apellido.required' => 'El primer apellido es obligatorio',
            'correo.required' => 'El correo es obligatorio',
            'correo.email' => 'El correo debe ser válido',
            'correo.unique' => 'Este correo ya está registrado',
            'cargo.required' => 'El cargo es obligatorio',
            'id_abreviatura.exists' => 'La abreviatura seleccionada no es válida',
        ];

        // Si se marca crear usuario, agregar validaciones de usuario
        if ($request->has('crear_usuario')) {
            $rules['username'] = 'required|string|max:50|unique:usuarios,username|regex:/^[a-zA-Z0-9._-]+$/';
            $rules['password'] = 'required|string|min:8|confirmed';
            $rules['id_rol'] = 'required|exists:roles,id_rol';

            $messages['username.required'] = 'El nombre de usuario es obligatorio';
            $messages['username.unique'] = 'Este nombre de usuario ya está en uso';
            $messages['username.regex'] = 'El nombre de usuario solo puede contener letras, números, puntos, guiones y guiones bajos';
            $messages['password.required'] = 'La contraseña es obligatoria';
            $messages['password.min'] = 'La contraseña debe tener al menos 8 caracteres';
            $messages['password.confirmed'] = 'Las contraseñas no coinciden';
            $messages['id_rol.required'] = 'Debe seleccionar un rol';
            $messages['id_rol.exists'] = 'El rol seleccionado no es válido';
        }

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Error al crear el directivo');
        }

        DB::beginTransaction();
        try {
            $usuarioId = null;

            // Crear usuario si se solicita
            if ($request->has('crear_usuario')) {
                $usuario = Usuario::create([
                    'username' => $request->username,
                    'password' => Hash::make($request->password),
                    'id_rol' => $request->id_rol,
                    'estado' => 'Activo'
                ]);
                $usuarioId = $usuario->id_usuario;
            }

            // Crear directivo
            Directivo::create([
                'nombres' => $request->nombres,
                'primer_apellido' => $request->primer_apellido,
                'segundo_apellido' => $request->segundo_apellido,
                'correo' => $request->correo,
                'cargo' => $request->cargo,
                'id_abreviatura' => $request->id_abreviatura,
                'id_usuario' => $usuarioId
            ]);

            DB::commit();

            $mensaje = $request->has('crear_usuario') 
                ? 'Directivo y usuario creados exitosamente' 
                : 'Directivo creado exitosamente';

            return redirect()->route('directivos.index')
                ->with('success', $mensaje);

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->with('error', 'Error al crear el directivo: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $directivo = Directivo::with(['abreviatura', 'usuario.rol'])->findOrFail($id);
        return response()->json($directivo);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $directivo = Directivo::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'nombres' => 'required|string|max:100',
            'primer_apellido' => 'required|string|max:100',
            'segundo_apellido' => 'nullable|string|max:100',
            'correo' => 'required|email|max:150|unique:directivos,correo,' . $id . ',id_directivo',
            'cargo' => 'required|string|max:100',
            'id_abreviatura' => 'nullable|exists:abreviaturas,id_abreviatura',
            'id_usuario' => 'nullable|exists:usuarios,id_usuario'
        ], [
            'nombres.required' => 'El nombre es obligatorio',
            'primer_apellido.required' => 'El primer apellido es obligatorio',
            'correo.required' => 'El correo es obligatorio',
            'correo.email' => 'El correo debe ser válido',
            'correo.unique' => 'Este correo ya está registrado',
            'cargo.required' => 'El cargo es obligatorio',
            'id_abreviatura.exists' => 'La abreviatura seleccionada no es válida',
            'id_usuario.exists' => 'El usuario seleccionado no es válido'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Error al actualizar el directivo');
        }

        $directivo->update($request->all());

        return redirect()->route('directivos.index')
            ->with('success', 'Directivo actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $directivo = Directivo::findOrFail($id);
            
            // Si tiene usuario asociado, también eliminarlo (opcional)
            if ($directivo->id_usuario) {
                $usuario = Usuario::find($directivo->id_usuario);
                if ($usuario) {
                    $usuario->delete();
                }
            }
            
            $directivo->delete();

            return redirect()->route('directivos.index')
                ->with('success', 'Directivo eliminado exitosamente');
        } catch (\Exception $e) {
            return redirect()->route('directivos.index')
                ->with('error', 'No se puede eliminar el directivo: ' . $e->getMessage());
        }
    }
}