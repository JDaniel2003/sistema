<?php

namespace App\Http\Controllers;

use App\Models\Abreviatura;
use App\Models\Docente;
use App\Models\DatosDocente;
use App\Models\Genero;
use App\Models\DomicilioDocente;
use App\Models\Usuario;
use App\Models\Distrito;
use App\Models\Estado;
use App\Models\Rol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class DocentesController extends Controller
{
    public function index()
    {
        $docentes = Docente::with(['datosDocentes.domicilioDocente', 'datosDocentes.genero', 'datosDocentes.abreviatura', 'usuario.rol'])->get();
        $generos = Genero::all();
        $distritos = Distrito::all();
        $estados = Estado::all();
        $roles = Rol::all();
        $abreviaturas = Abreviatura::all();

        return view('docente.index', compact('docentes', 'generos', 'distritos', 'estados', 'roles', 'abreviaturas'));
    }

    public function store(Request $request)
    {
        // Validaciones personalizadas
        $messages = [
            'required' => 'El campo :attribute es obligatorio.',
            'string' => 'El campo :attribute debe ser texto.',
            'max' => 'El campo :attribute no puede tener más de :max caracteres.',
            'min' => 'El campo :attribute debe tener al menos :min caracteres.',
            'size' => 'El campo :attribute debe tener exactamente :size caracteres.',
            'unique' => 'El :attribute ya está registrado en el sistema.',
            'email' => 'Debe ingresar un correo electrónico válido.',
            'date' => 'Debe ingresar una fecha válida.',
            'integer' => 'El campo :attribute debe ser un número entero.',
            'exists' => 'El valor seleccionado no es válido.',
            'confirmed' => 'La confirmación de contraseña no coincide.',
            'regex' => 'El formato del campo :attribute no es válido.',
            'numeric' => 'El campo :attribute debe ser numérico.',
            'digits' => 'El campo :attribute debe tener :digits dígitos.',
            'alpha' => 'El campo :attribute solo debe contener letras.',
            'before' => 'La fecha debe ser anterior a hoy.',
        ];

        $attributes = [
            'especialidad' => 'especialidad',
            'datos_docentes.nombre' => 'nombre',
            'datos_docentes.apellido_paterno' => 'apellido paterno',
            'datos_docentes.apellido_materno' => 'apellido materno',
            'datos_docentes.fecha_nacimiento' => 'fecha de nacimiento',
            'datos_docentes.edad' => 'edad',
            'datos_docentes.id_genero' => 'género',
            'datos_docentes.id_abreviatura' => 'título/abreviatura',
            'datos_docentes.cedula_profesional' => 'cédula profesional',
            'datos_docentes.rfc' => 'RFC',
            'datos_docentes.curp' => 'CURP',
            'datos_docentes.telefono' => 'teléfono',
            'datos_docentes.correo' => 'correo electrónico',
            'datos_docentes.numero_seguridad_social' => 'número de seguridad social',
            'domicilio_docente.calle' => 'calle',
            'domicilio_docente.colonia' => 'colonia',
            'domicilio_docente.municipio' => 'municipio',
            'domicilio_docente.id_estado' => 'estado',
            'domicilio_docente.numero_exterior' => 'número exterior',
            'domicilio_docente.numero_interior' => 'número interior',
            'domicilio_docente.codigo_postal' => 'código postal',
            'domicilio_docente.id_distrito' => 'distrito',
            'usuario.username' => 'nombre de usuario',
            'usuario.password' => 'contraseña',
            'usuario.id_rol' => 'rol',
        ];

        $validated = $request->validate([
            // Docente
            'especialidad' => 'required|string|max:100',
            
            // Datos personales
            'datos_docentes.nombre' => 'required|string|max:100|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/',
            'datos_docentes.apellido_paterno' => 'required|string|max:50|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/',
            'datos_docentes.apellido_materno' => 'nullable|string|max:50|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/',
            'datos_docentes.fecha_nacimiento' => 'required|date|before:today',
            'datos_docentes.edad' => 'required|integer|min:18|max:100',
            'datos_docentes.id_genero' => 'required|exists:generos,id_genero',
            'datos_docentes.id_abreviatura' => 'nullable|exists:abreviaturas,id_abreviatura',
            'datos_docentes.cedula_profesional' => 'nullable|string|size:7|unique:datos_docentes,cedula_profesional|regex:/^[0-9]+$/',
            'datos_docentes.rfc' => 'nullable|string|size:13|unique:datos_docentes,rfc|regex:/^[A-ZÑ&]{3,4}[0-9]{6}[A-Z0-9]{3}$/',
            'datos_docentes.curp' => 'nullable|string|size:18|unique:datos_docentes,curp|regex:/^[A-Z]{4}[0-9]{6}[HM][A-Z]{5}[0-9A-Z][0-9]$/',
            'datos_docentes.telefono' => 'required|string|size:10|regex:/^[0-9]+$/',
            'datos_docentes.correo' => 'required|email|max:100|unique:datos_docentes,correo',
            'datos_docentes.numero_seguridad_social' => 'nullable|string|size:11|unique:datos_docentes,numero_seguridad_social|regex:/^[0-9]+$/',
            
            // Domicilio
            'domicilio_docente.calle' => 'required|string|max:100',
            'domicilio_docente.colonia' => 'required|string|max:100',
            'domicilio_docente.municipio' => 'required|string|max:100',
            'domicilio_docente.id_estado' => 'required|exists:estado,id_estado',
            'domicilio_docente.numero_exterior' => 'nullable|string|max:10',
            'domicilio_docente.numero_interior' => 'nullable|string|max:10',
            'domicilio_docente.codigo_postal' => 'nullable|string|size:5|regex:/^[0-9]+$/',
            'domicilio_docente.id_distrito' => 'nullable|exists:distritos,id_distrito',
            
            // Usuario (opcional pero con validaciones condicionales)
            'usuario.username' => 'nullable|string|max:50|unique:usuarios,username|regex:/^[a-zA-Z0-9_]+$/',
            'usuario.password' => 'nullable|required_with:usuario.username|string|min:8|confirmed',
            'usuario.id_rol' => 'nullable|required_with:usuario.username|exists:roles,id_rol',
        ], $messages, $attributes);

        DB::beginTransaction();
        try {
            // Crear domicilio
            $domicilio = DomicilioDocente::create($validated['domicilio_docente']);

            // Crear datos personales
            $datosDocente = DatosDocente::create(array_merge(
                $validated['datos_docentes'],
                ['id_domicilio_docente' => $domicilio->id_domicilio_docente]
            ));

            // Crear usuario (opcional)
            $idUsuario = null;
            if (!empty($validated['usuario']['username']) && !empty($validated['usuario']['password'])) {
                $usuario = Usuario::create([
                    'username' => $validated['usuario']['username'],
                    'password' => Hash::make($validated['usuario']['password']),
                    'id_rol' => $validated['usuario']['id_rol'] ?? 3,
                ]);
                $idUsuario = $usuario->id_usuario;
            }

            // Crear docente
            Docente::create([
                'id_datos_docentes' => $datosDocente->id_datos_docentes,
                'id_usuario' => $idUsuario,
                'especialidad' => $validated['especialidad'],
            ]);

            DB::commit();
            return redirect()->route('docente.index')->with('success', '✓ Docente registrado exitosamente.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Error al registrar el docente: ' . $e->getMessage()])->withInput();
        }
    }

    public function update(Request $request, $id)
    {
        $docente = Docente::with('datosDocentes.domicilioDocente', 'usuario')->findOrFail($id);
        $datos = $docente->datosDocentes;

        // Mensajes personalizados
        $messages = [
            'required' => 'El campo :attribute es obligatorio.',
            'string' => 'El campo :attribute debe ser texto.',
            'max' => 'El campo :attribute no puede tener más de :max caracteres.',
            'min' => 'El campo :attribute debe tener al menos :min caracteres.',
            'size' => 'El campo :attribute debe tener exactamente :size caracteres.',
            'unique' => 'El :attribute ya está registrado en el sistema.',
            'email' => 'Debe ingresar un correo electrónico válido.',
            'date' => 'Debe ingresar una fecha válida.',
            'integer' => 'El campo :attribute debe ser un número entero.',
            'exists' => 'El valor seleccionado no es válido.',
            'confirmed' => 'La confirmación de contraseña no coincide.',
            'regex' => 'El formato del campo :attribute no es válido.',
            'before' => 'La fecha debe ser anterior a hoy.',
        ];

        $attributes = [
            'especialidad' => 'especialidad',
            'datos_docentes.nombre' => 'nombre',
            'datos_docentes.apellido_paterno' => 'apellido paterno',
            'datos_docentes.apellido_materno' => 'apellido materno',
            'datos_docentes.fecha_nacimiento' => 'fecha de nacimiento',
            'datos_docentes.edad' => 'edad',
            'datos_docentes.id_genero' => 'género',
            'datos_docentes.id_abreviatura' => 'título/abreviatura',
            'datos_docentes.cedula_profesional' => 'cédula profesional',
            'datos_docentes.rfc' => 'RFC',
            'datos_docentes.curp' => 'CURP',
            'datos_docentes.telefono' => 'teléfono',
            'datos_docentes.correo' => 'correo electrónico',
            'datos_docentes.numero_seguridad_social' => 'número de seguridad social',
            'domicilio_docente.calle' => 'calle',
            'domicilio_docente.colonia' => 'colonia',
            'domicilio_docente.municipio' => 'municipio',
            'domicilio_docente.id_estado' => 'estado',
            'usuario.username' => 'nombre de usuario',
            'usuario.password' => 'contraseña',
        ];

        $validated = $request->validate([
            'especialidad' => 'required|string|max:100',

            'datos_docentes.nombre' => 'required|string|max:100|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/',
            'datos_docentes.apellido_paterno' => 'required|string|max:50|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/',
            'datos_docentes.apellido_materno' => 'nullable|string|max:50|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/',
            'datos_docentes.fecha_nacimiento' => 'required|date|before:today',
            'datos_docentes.edad' => 'required|integer|min:18|max:100',
            'datos_docentes.id_genero' => 'required|exists:generos,id_genero',
            'datos_docentes.id_abreviatura' => 'nullable|exists:abreviaturas,id_abreviatura',

            'datos_docentes.cedula_profesional' => [
                'nullable',
                'string',
                'size:7',
                'regex:/^[0-9]+$/',
                Rule::unique('datos_docentes', 'cedula_profesional')->ignore($datos->id_datos_docentes, 'id_datos_docentes')
            ],

            'datos_docentes.rfc' => [
                'nullable',
                'string',
                'size:13',
                'regex:/^[A-ZÑ&]{3,4}[0-9]{6}[A-Z0-9]{3}$/',
                Rule::unique('datos_docentes', 'rfc')->ignore($datos->id_datos_docentes, 'id_datos_docentes')
            ],

            'datos_docentes.curp' => [
                'nullable',
                'string',
                'size:18',
                'regex:/^[A-Z]{4}[0-9]{6}[HM][A-Z]{5}[0-9A-Z][0-9]$/',
                Rule::unique('datos_docentes', 'curp')->ignore($datos->id_datos_docentes, 'id_datos_docentes')
            ],

            'datos_docentes.correo' => [
                'required',
                'email',
                'max:100',
                Rule::unique('datos_docentes', 'correo')->ignore($datos->id_datos_docentes, 'id_datos_docentes')
            ],

            'datos_docentes.telefono' => 'required|string|size:10|regex:/^[0-9]+$/',

            'datos_docentes.numero_seguridad_social' => [
                'nullable',
                'string',
                'size:11',
                'regex:/^[0-9]+$/',
                Rule::unique('datos_docentes', 'numero_seguridad_social')->ignore($datos->id_datos_docentes, 'id_datos_docentes')
            ],

            'domicilio_docente.calle' => 'required|string|max:100',
            'domicilio_docente.colonia' => 'required|string|max:100',
            'domicilio_docente.municipio' => 'required|string|max:100',
            'domicilio_docente.id_estado' => 'required|exists:estado,id_estado',
            'domicilio_docente.numero_exterior' => 'nullable|string|max:10',
            'domicilio_docente.numero_interior' => 'nullable|string|max:10',
            'domicilio_docente.codigo_postal' => 'nullable|string|size:5|regex:/^[0-9]+$/',
            'domicilio_docente.id_distrito' => 'nullable|exists:distritos,id_distrito',

            'usuario.username' => [
                'nullable',
                'string',
                'max:50',
                'regex:/^[a-zA-Z0-9_]+$/',
                Rule::unique('usuarios', 'username')->ignore($docente->usuario?->id_usuario ?? 0, 'id_usuario')
            ],

            'usuario.password' => 'nullable|string|min:8|confirmed',
            'usuario.id_rol' => 'nullable|exists:roles,id_rol',
        ], $messages, $attributes);

        DB::beginTransaction();
        try {
            // Actualizar domicilio
            $domicilio = $datos->domicilioDocente;
            if ($domicilio) {
                $domicilio->update($validated['domicilio_docente']);
            } else {
                $domicilio = DomicilioDocente::create($validated['domicilio_docente']);
                $datos->id_domicilio_docente = $domicilio->id_domicilio_docente;
                $datos->save();
            }

            // Actualizar datos personales
            $datos->update($validated['datos_docentes']);

            // Actualizar o crear usuario
            if (!empty($validated['usuario']['username'])) {
                $usuario = $docente->usuario;

                if ($usuario) {
                    // Actualizar usuario existente
                    $usuarioData = [
                        'username' => $validated['usuario']['username'],
                        'id_rol' => $validated['usuario']['id_rol'] ?? $usuario->id_rol,
                    ];

                    if (!empty($validated['usuario']['password'])) {
                        $usuarioData['password'] = Hash::make($validated['usuario']['password']);
                    }

                    $usuario->update($usuarioData);
                } else {
                    // Crear nuevo usuario
                    if (!empty($validated['usuario']['password'])) {
                        $nuevo = Usuario::create([
                            'username' => $validated['usuario']['username'],
                            'password' => Hash::make($validated['usuario']['password']),
                            'id_rol' => $validated['usuario']['id_rol'] ?? 3,
                        ]);
                        $docente->id_usuario = $nuevo->id_usuario;
                    }
                }
            }

            // Actualizar docente
            $docente->update([
                'especialidad' => $validated['especialidad'],
            ]);

            DB::commit();
            return redirect()->route('docente.index')->with('success', '✓ Docente actualizado exitosamente.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Error al actualizar el docente: ' . $e->getMessage()])->withInput();
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $docente = Docente::with('datosDocentes.domicilioDocente')->findOrFail($id);
            $datosDocente = $docente->datosDocentes;
            $domicilio = $datosDocente->domicilioDocente;

            // Eliminar en orden correcto
            $docente->delete();
            $datosDocente->delete();
            
            if ($domicilio) {
                $domicilio->delete();
            }

            DB::commit();
            return redirect()->route('docentes.index')->with('success', '✓ Docente eliminado exitosamente.');
            
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Error al eliminar el docente: ' . $e->getMessage()]);
        }
    }
}