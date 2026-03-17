<?php

/**
 * @file create_peliculas_table.php
 * @author Carlos Vico
 * @description Migración para la tabla peliculas
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Crea la tabla peliculas.
     * 'año' como unsignedSmallInteger: rango suficiente (0-65535) y más eficiente que INT.
     */
    public function up(): void
    {
        Schema::create('peliculas', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('director');
            $table->unsignedSmallInteger('año');
            $table->timestamps();
        });
    }

    /**
     * Revierte la migración eliminando la tabla.
     */
    public function down(): void
    {
        Schema::dropIfExists('peliculas');
    }
};