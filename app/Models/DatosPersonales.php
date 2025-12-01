<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DatosPersonales extends Model
{
    use HasFactory;

    protected $table = 'datos_personales';
    protected $primaryKey = 'id_datos_personales';
    public $timestamps = false;

    protected $fillable = [
        
        'correo',
        'telefono',
        'nombres',
        'primer_apellido',
        'segundo_apellido',
        'curp',
        'fecha_nacimiento',
        'edad',
        'lugar_nacimiento',
        'estado_nacimiento',
        'id_estado_civil',
        'id_tipo_sangre',
        'id_domicilio_alumno',
        'id_lengua_indigena',
        'id_discapacidad',
        'id_datos_tutor',
        'hijos',
        'id_datos_escuela_procedencia',
        'id_genero',
        'numero_seguridad_social',
        'datos'
    ];

    protected $casts = [
        'datos' => 'array',
        'fecha_nacimiento' => 'date'
    ];

    public function alumno()
    {
        return $this->hasOne(Alumno::class, 'id_datos_personales', 'id_datos_personales');
    }
    

    public function tutor()
    {
        return $this->belongsTo(Tutor::class, 'id_datos_tutor', 'id_datos_tutor'); 
    }


    public function estadoCivil()
{
    return $this->belongsTo(EstadoCivil::class, 'id_estado_civil', 'id_estado_civil');
}

public function tipoSangre()
{
    return $this->belongsTo(TipoSangre::class, 'id_tipo_sangre', 'id_tipo_sangre');
}

public function genero()
{
    return $this->belongsTo(Genero::class, 'id_genero', 'id_genero');
}

public function lenguaIndigena()
{
    return $this->belongsTo(LenguaIndigena::class, 'id_lengua_indigena', 'id_lengua_indigena');
}

public function discapacidad()
{
    return $this->belongsTo(Discapacidad::class, 'id_discapacidad', 'id_discapacidad');
}
public function domicilioAlumno()
{
    return $this->belongsTo(DomicilioAlumno::class, 'id_domicilio_alumno', 'id_domicilio_alumno');
}
public function estadoNacimiento()
{
    return $this->belongsTo(Estado::class, 'estado_nacimiento', 'id_estado');
}

protected static function booted()
{
    static::deleting(function ($datosPersonales) {
        Tutor::where('id_datos_tutor', $datosPersonales->id_datos_tutor)->delete();

        // 3. Eliminar Datos de la Escuela de Procedencia
        EscuelaProcedencia::where('id_datos_escuela_procedencia', $datosPersonales->id_datos_escuela_procedencia)->delete();
        
        // 1. Eliminar Domicilio del Alumno (RELACIÓN CORREGIDA)
        if ($datosPersonales->domicilioAlumno) {
            // El modelo DomiciliosAlumnos es eliminado
            $datosPersonales->domicilioAlumno->delete(); 
        }

        // 2. Eliminar Datos del Tutor (Esta llamada dispara la eliminación del Domicilio del Tutor)
        if ($datosPersonales->tutor) {
            $datosPersonales->tutor->delete();
        }

        // 3. Eliminar Datos de la Escuela de Procedencia
        if ($datosPersonales->escuelaProcedencia) {
            $datosPersonales->escuelaProcedencia->delete();
        }
    });
}
}



