<?php

/**
 * @file Pelicula.php
 * @author Carlos Vico
 * @description Modelo Eloquent para la tabla peliculas
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class Pelicula extends Model
{
    /**
     * Campos asignables en masa.
     * Se omite 'id' y timestamps para protección contra mass assignment.
     *
     * @var array<string>
     */
    protected $fillable = [
        'titulo',
        'director',
        'año',
    ];

    /**
     * Cast de 'año' a integer para evitar comparaciones de tipo string.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'año' => 'integer',
    ];
}