<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AlumnoSeeder extends Seeder
{
    public function run()
    {
        $total = 40; // 🔹 cantidad de alumnos a generar

        $datosPersonales = [];
        $datosAcademicos = [];
        $alumnos = [];

        for ($i = 1; $i <= $total; $i++) {

            // ============================
            // 🔹 1. DATOS PERSONALES
            // ============================
            $correo = "alumno{$i}_" . Str::random(3) . "@gmail.com";

            $datosPersonales[] = [
                'correo' => $correo,
                'telefono' => "5550" . rand(100000, 999999),
                'nombres' => "Alumno{$i}",
                'primer_apellido' => "Apellido{$i}",
                'segundo_apellido' => "Segundo{$i}",
                'curp' => "CURP" . str_pad($i, 6, "0", STR_PAD_LEFT) . Str::random(3),
                'fecha_nacimiento' => '2005-01-15',
                'edad' => 19,
                'datos' => json_encode(['beca' => $i % 2 === 0])
            ];

            // ============================
            // 🔹 2. DATOS ACADÉMICOS
            // ============================
            $datosAcademicos[] = [
                'matricula' => "20250" . str_pad($i, 3, "0", STR_PAD_LEFT) . rand(100, 999),
                'id_carrera' => rand(1, 1),
                'id_plan_estudio' => rand(1, 1),
            ];
        }

        // Guardar datos personales
        DB::table('datos_personales')->insert($datosPersonales);

        // Guardar datos académicos
        DB::table('datos_academicos')->insert($datosAcademicos);

        // OBTENER LOS ÚLTIMOS 40 IDs DE CADA TABLA
        $idsPersonales = DB::table('datos_personales')
            ->orderBy('id_datos_personales', 'desc')
            ->limit($total)
            ->pluck('id_datos_personales')
            ->reverse()
            ->values()
            ->toArray();

        $idsAcademicos = DB::table('datos_academicos')
            ->orderBy('id_datos_academicos', 'desc')
            ->limit($total)
            ->pluck('id_datos_academicos')
            ->reverse()
            ->values()
            ->toArray();

        // ============================
        // 🔹 3. ALUMNOS (relaciones)
        // ============================
        for ($i = 0; $i < $total; $i++) {
            $alumnos[] = [
                'id_datos_personales' => $idsPersonales[$i],
                'id_datos_academicos' => $idsAcademicos[$i],
                'id_generacion' => 2,
                'estatus' => 2,
                'servicios_social' => false
            ];
        }

        DB::table('alumnos')->insert($alumnos);
    }
}
