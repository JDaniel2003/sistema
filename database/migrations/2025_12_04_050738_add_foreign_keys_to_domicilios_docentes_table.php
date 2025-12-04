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
        Schema::table('domicilios_docentes', function (Blueprint $table) {
            $table->foreign(['id_distrito'], 'domicilios_docentes_ibfk_1')->references(['id_distrito'])->on('distritos')->onUpdate('cascade')->onDelete('set null');
            $table->foreign(['id_estado'], 'domicilios_docentes_ibfk_2')->references(['id_estado'])->on('estado')->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('domicilios_docentes', function (Blueprint $table) {
            $table->dropForeign('domicilios_docentes_ibfk_1');
            $table->dropForeign('domicilios_docentes_ibfk_2');
        });
    }
};
