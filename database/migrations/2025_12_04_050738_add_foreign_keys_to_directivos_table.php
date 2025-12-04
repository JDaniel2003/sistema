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
        Schema::table('directivos', function (Blueprint $table) {
            $table->foreign(['id_abreviatura'], 'directivos_ibfk_1')->references(['id_abreviatura'])->on('abreviaturas')->onUpdate('cascade')->onDelete('set null');
            $table->foreign(['id_usuario'], 'directivos_ibfk_2')->references(['id_usuario'])->on('usuarios')->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('directivos', function (Blueprint $table) {
            $table->dropForeign('directivos_ibfk_1');
            $table->dropForeign('directivos_ibfk_2');
        });
    }
};
