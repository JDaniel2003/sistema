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
        Schema::table('grupos', function (Blueprint $table) {
            $table->foreign(['id_turno'], 'grupos_ibfk_1')->references(['id_turno'])->on('turnos')->onUpdate('cascade')->onDelete('set null');
            $table->foreign(['id_carrera'], 'grupos_ibfk_2')->references(['id_carrera'])->on('carreras')->onUpdate('cascade')->onDelete('set null');
            $table->foreign(['periodo'], 'grupos_ibfk_3')->references(['id_periodo_escolar'])->on('periodos_escolares')->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('grupos', function (Blueprint $table) {
            $table->dropForeign('grupos_ibfk_1');
            $table->dropForeign('grupos_ibfk_2');
            $table->dropForeign('grupos_ibfk_3');
        });
    }
};
