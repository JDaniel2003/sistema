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
        Schema::table('alumnos', function (Blueprint $table) {
            $table->foreign(['id_datos_personales'], 'alumnos_ibfk_1')->references(['id_datos_personales'])->on('datos_personales')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['id_datos_academicos'], 'alumnos_ibfk_2')->references(['id_datos_academicos'])->on('datos_academicos')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['id_generacion'], 'alumnos_ibfk_3')->references(['id_generacion'])->on('generaciones')->onUpdate('cascade')->onDelete('set null');
            $table->foreign(['estatus'], 'alumnos_ibfk_4')->references(['id_historial_status'])->on('historial_status')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('alumnos', function (Blueprint $table) {
            $table->dropForeign('alumnos_ibfk_1');
            $table->dropForeign('alumnos_ibfk_2');
            $table->dropForeign('alumnos_ibfk_3');
            $table->dropForeign('alumnos_ibfk_4');
        });
    }
};
