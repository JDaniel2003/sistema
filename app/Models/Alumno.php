<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    use HasFactory;

    protected $table = 'alumnos';
    protected $primaryKey = 'id_alumno';
    public $timestamps = false;

    protected $fillable = [
        'estatus',
        'id_datos_personales',
        'id_datos_academicos',
        'id_generacion',
        'servicios_social',
        'datos'
    ];

    protected $casts = [
        'datos' => 'array',
        'servicios_social' => 'boolean',
    ];

    // 🔹 DATOS PERSONALES
    public function datosPersonales()
    {
        return $this->belongsTo(DatosPersonales::class, 'id_datos_personales', 'id_datos_personales');
    }

    // 🔹 DATOS ACADÉMICOS
    public function datosAcademicos()
    {
        return $this->belongsTo(DatosAcademicos::class, 'id_datos_academicos', 'id_datos_academicos');
    }

    // 🔹 STATUS ACADÉMICO
    public function statusAcademico()
    {
        return $this->belongsTo(HistorialStatus::class, 'estatus', 'id_historial_status');
    }
    public function generaciones()
    {
        return $this->belongsTo(Generacion::class, 'id_generacion', 'id_generacion');
    }

    // 🔹 DOMICILIO DEL ALUMNO (a través de datos_personales)
    public function domicilioAlumno()
    {
        return $this->hasOneThrough(
            DomicilioAlumno::class,
            DatosPersonales::class,
            'id_datos_personales',     // FK en datos_personales
            'id_domicilio_alumno',     // FK en domicilio_alumno
            'id_datos_personales',     // local key en alumnos
            'id_domicilio_alumno'      // local key en datos_personales
        );
    }

    // 🔹 TUTOR (a través de datos_personales)
    public function tutor()
    {
        return $this->hasOneThrough(
            Tutor::class,
            DatosPersonales::class,
            'id_datos_personales',     // FK en datos_personales
            'id_datos_tutor',          // FK en tutor
            'id_datos_personales',     // local key en alumnos
            'id_datos_tutor'           // local key en datos_personales
        );
    }

    // 🔹 DOMICILIO DEL TUTOR (a través del tutor)
    public function domicilioTutor()
    {
        return $this->hasOneThrough(
            DomicilioTutor::class,
            Tutor::class,
            'id_datos_tutor',          // FK en tutor
            'id_domicilio_tutor',      // FK en domicilio_tutor
            'id_datos_personales',     // local key en alumnos
            'id_domicilio_tutor'       // local key en tutor
        );
    }

    // 🔹 ESCUELA DE PROCEDENCIA (a través de datos_personales)
    public function escuelaProcedencia()
    {
        return $this->hasOneThrough(
            EscuelaProcedencia::class,
            DatosPersonales::class,
            'id_datos_personales',             // FK en datos_personales
            'id_datos_escuela_procedencia',    // FK en escuela_procedencia
            'id_datos_personales',             // local key en alumnos
            'id_datos_escuela_procedencia'     // local key en datos_personales
        );
    }

 

    // 🔹 ÁREA DE ESPECIALIZACIÓN (si aplica)
    public function areaEspecializacion()
    {
        return $this->belongsTo(AreaEspecializacion::class, 'id_area_especializacion', 'id_area_especializacion');
    }

    // 🔹 BECA (si aplica)
    public function beca()
    {
        return $this->belongsTo(Beca::class, 'id_beca', 'id_beca');
    }
    public function historial()
{
    return $this->hasMany(Historial::class, 'id_alumno');
}

public function calificaciones()
    {
        return $this->hasMany(Calificacion::class, 'id_alumno');
    }
protected static function booted()
{
    static::deleting(function ($alumno) {
        // 1. Eliminar Datos Académicos
        // Si DatosAcademicos es el padre de otras relaciones (ej: inscripciones),
        // asegúrese de agregar el método 'deleting' también a ese modelo.
        if ($alumno->datosAcademicos) {
            $alumno->datosAcademicos->delete();
        }

        // 2. Eliminar Datos Personales
        // Esta es la clave que iniciará la cadena de eliminación de:
        // DatosPersonales -> DatosTutor -> DomicilioTutor
        // DatosPersonales -> DomicilioAlumno
        // DatosPersonales -> EscuelaProcedencia
        if ($alumno->datosPersonales) {
            $alumno->datosPersonales->delete();
        }

        // 3. Eliminar Historial
        // Borra los registros de historial asociados directamente a este alumno.
        $alumno->historial()->delete();

        // 4. Eliminar Calificaciones
        // Borra todas las calificaciones asociadas a este alumno.
        $alumno->calificaciones()->delete();

        // Nota: Asegúrese de que las relaciones secundarias (como DatosTutor y DomicilioAlumno)
        // también tengan su propia lógica 'deleting' o usen claves ON DELETE CASCADE
        // en la base de datos (InnoDB) para completar la limpieza total.
    });
}

}
