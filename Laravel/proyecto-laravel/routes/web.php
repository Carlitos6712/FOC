<?php

/**
 * @file web.php
 * @author Carlos Vico
 * @description Rutas web de la aplicación Laravel
 */

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;

/*
|--------------------------------------------------------------------------
| EJERCICIO 1 — Ruta simple
|--------------------------------------------------------------------------
*/
Route::get('/inicio', function () {
    return 'Bienvenido a mi primera aplicación en Laravel';
});

/*
|--------------------------------------------------------------------------
| EJERCICIO 2 — Ruta con parámetro
|--------------------------------------------------------------------------
*/
Route::get('/saludo/{nombre}', function (string $nombre) {
    return "Hola {$nombre}, bienvenido a Laravel";
});

/*
|--------------------------------------------------------------------------
| EJERCICIO 3 — Ruta con dos parámetros numéricos
| Se castea a float para soportar decimales además de enteros
|--------------------------------------------------------------------------
*/
Route::get('/suma/{num1}/{num2}', function (string $num1, string $num2) {
    $resultado = (float) $num1 + (float) $num2;
    return "La suma es: {$resultado}";
});

/*
|--------------------------------------------------------------------------
| EJERCICIO 4 y 5 — Rutas del ProductoController
|--------------------------------------------------------------------------
*/
Route::get('/productos', [ProductoController::class, 'index']);
Route::get('/producto/{id}', [ProductoController::class, 'mostrar']);

/*
|--------------------------------------------------------------------------
| EJERCICIO 6 y 7 — Rutas con vistas Blade
|--------------------------------------------------------------------------
*/
Route::get('/bienvenida', function () {
    return view('bienvenida');
});

Route::get('/hola', function () {
    return view('saludo', ['nombre' => 'Carlos']);
});

/*
|--------------------------------------------------------------------------
| EJERCICIO 8 — Ruta con array hacia vista
|--------------------------------------------------------------------------
*/
Route::get('/frutas', function () {
    $frutas = ['manzana', 'pera', 'plátano', 'naranja'];
    return view('frutas', compact('frutas'));
});

/*
|--------------------------------------------------------------------------
| EJERCICIOS 11-14 — CRUD de Libros
| NOTA: En producción estos irían en un controlador con rutas REST
|--------------------------------------------------------------------------
*/
use App\Models\Libro;

Route::get('/libros/crear', function () {
    $libro = Libro::create([
        'titulo' => 'El Quijote',
        'autor'  => 'Cervantes',
        'precio' => 20,
    ]);
    return "Libro creado: {$libro->titulo}";
});

Route::get('/libros', function () {
    $libros = Libro::all();
    return $libros->map(fn($l) => "{$l->titulo} - {$l->autor} - {$l->precio}€")->join('<br>');
});

Route::get('/libros/actualizar', function () {
    // Eager load por ID para evitar consultas N+1 en listados futuros
    $libro = Libro::findOrFail(1);
    $libro->update(['precio' => 25]);
    return "Precio actualizado a: {$libro->precio}€";
});

Route::get('/libros/eliminar', function () {
    Libro::findOrFail(1)->delete();
    return 'Libro eliminado correctamente';
});
