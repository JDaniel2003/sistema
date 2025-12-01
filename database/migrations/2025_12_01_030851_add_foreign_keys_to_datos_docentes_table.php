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
        Schema::table('datos_docentes', function (Blueprint $table) {
            $table->foreign(['id_domicilio_docente'], 'datos_docentes_ibfk_1')->references(['id_domicilio_docente'])->on('domicilios_docentes')->onUpdate('cascade')->onDelete('set null');
            $table->foreign(['id_abreviatura'], 'datos_docentes_ibfk_2')->references(['id_abreviatura'])->on('abreviaturas')->onUpdate('cascade')->onDelete('set null');
            $table->foreign(['id_genero'], 'datos_docentes_ibfk_3')->references(['id_genero'])->on('generos')->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('datos_docentes', function (Blueprint $table) {
            $table->dropForeign('datos_docentes_ibfk_1');
            $table->dropForeign('datos_docentes_ibfk_2');
            $table->dropForeign('datos_docentes_ibfk_3');
        });
    }
};
