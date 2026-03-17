<?php

/**
 * @file Libro.php
 * @author Carlos Vico
 * @description Modelo Eloquent para la tabla libros
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    /**
     * Campos asignables en masa.
     * Se excluye 'id' y timestamps por seguridad (mass assignment protection).
     *
     * @var array<string>
     */
    protected $fillable = [
        'titulo',
        'autor',
        'precio',
    ];
}