<?php

/**
 * @file create_libros_table.php
 * @author Carlos Vico
 * @description Migración para la tabla libros
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Crea la tabla libros con sus campos definidos.
     * precio como decimal para evitar errores de redondeo con floats.
     */
    public function up(): void
    {
        Schema::create('libros', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('autor');
            $table->decimal('precio', 8, 2);
            $table->timestamps(); // created_at + updated_at
        });
    }

    /**
     * Revierte la migración eliminando la tabla.
     */
    public function down(): void
    {
        Schema::dropIfExists('libros');
    }
};