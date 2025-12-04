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
        Schema::table('datos_tutores', function (Blueprint $table) {
            $table->foreign(['id_parentesco'], 'datos_tutores_ibfk_1')->references(['id_parentesco'])->on('parentescos')->onUpdate('cascade')->onDelete('set null');
            $table->foreign(['id_domicilio_tutor'], 'datos_tutores_ibfk_2')->references(['id_domicilio_tutor'])->on('domicilios_tutores')->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('datos_tutores', function (Blueprint $table) {
            $table->dropForeign('datos_tutores_ibfk_1');
            $table->dropForeign('datos_tutores_ibfk_2');
        });
    }
};
