<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('calificaciones', function (Blueprint $table) {
            $table->foreign(['id_alumno'], 'calificaciones_ibfk_1')->references(['id_alumno'])->on('alumnos')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['id_unidad'], 'calificaciones_ibfk_2')->references(['id_unidad'])->on('unidades')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['id_evaluacion'], 'calificaciones_ibfk_3')->references(['id_evaluacion'])->on('evaluaciones')->onUpdate('cascade')->onDelete('set null');
            $table->foreign(['id_asignacion'], 'calificaciones_ibfk_4')->references(['id_asignacion'])->on('asignaciones_docentes')->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('calificaciones', function (Blueprint $table) {
            $table->dropForeign('calificaciones_ibfk_1');
            $table->dropForeign('calificaciones_ibfk_2');
            $table->dropForeign('calificaciones_ibfk_3');
            $table->dropForeign('calificaciones_ibfk_4');
        });
    }
};
