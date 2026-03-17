<?php

/**
 * @file PeliculaController.php
 * @author Carlos Vico
 * @description Controlador CRUD para la gestión de películas.
 *              Sigue el patrón Resource de Laravel para mantener consistencia REST.
 */

namespace App\Http\Controllers;

use App\Models\Pelicula;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PeliculaController extends Controller
{
    /**
     * Muestra el listado de todas las películas.
     * Se ordena por año DESC para mostrar las más recientes primero.
     *
     * @return View
     */
    public function index(): View
    {
        $peliculas = Pelicula::orderBy('año', 'desc')->get();

        return view('peliculas.index', compact('peliculas'));
    }

    /**
     * Muestra el formulario para crear una nueva película.
     *
     * @return View
     */
    public function create(): View
    {
        return view('peliculas.create');
    }

    /**
     * Persiste una nueva película en la base de datos.
     * Se valida antes de insertar para garantizar integridad de datos.
     *
     * @param  Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'titulo'   => 'required|string|max:255',
            'director' => 'required|string|max:255',
            'año'      => 'required|integer|min:1888|max:' . date('Y'),
        ]);

        Pelicula::create($validated);

        return redirect()->route('peliculas.index')
                         ->with('success', 'Película creada correctamente.');
    }

    /**
     * Muestra el detalle de una película por su ID.
     *
     * @param  int $id
     * @return View
     */
    public function show(int $id): View
    {
        // findOrFail lanza 404 automáticamente si no existe — no necesitamos try/catch aquí
        $pelicula = Pelicula::findOrFail($id);

        return view('peliculas.show', compact('pelicula'));
    }

    /**
     * Muestra el formulario de edición de una película.
     *
     * @param  int $id
     * @return View
     */
    public function edit(int $id): View
    {
        $pelicula = Pelicula::findOrFail($id);

        return view('peliculas.edit', compact('pelicula'));
    }

    /**
     * Actualiza el título de una película existente.
     * Solo se permite modificar el título según los requisitos del ejercicio.
     *
     * @param  Request $request
     * @param  int     $id
     * @return RedirectResponse
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
        ]);

        $pelicula = Pelicula::findOrFail($id);
        $pelicula->update($validated);

        return redirect()->route('peliculas.index')
                         ->with('success', "Título actualizado a: {$pelicula->titulo}");
    }

    /**
     * Elimina una película de la base de datos.
     *
     * @param  int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        Pelicula::findOrFail($id)->delete();

        return redirect()->route('peliculas.index')
                         ->with('success', 'Película eliminada correctamente.');
    }
}