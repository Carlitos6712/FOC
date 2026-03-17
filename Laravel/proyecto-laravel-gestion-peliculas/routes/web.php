<?php

/**
 * @file web.php
 * @author Carlos Vico
 * @description Rutas de la aplicación — gestión de películas
 */

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeliculaController;

// Resource genera automáticamente las 7 rutas CRUD estándar de Laravel
Route::resource('peliculas', PeliculaController::class);