<?php

/**
 * @file ProductoController.php
 * @author Carlos Vico
 * @description Controlador de productos — gestiona listado y detalle
 */

namespace App\Http\Controllers;

use Illuminate\Http\Response;

class ProductoController extends Controller
{
    /**
     * Muestra el listado general de productos.
     *
     * @return Response
     */
    public function index(): Response
    {
        return response('Listado de productos');
    }

    /**
     * Muestra el detalle de un producto por su ID.
     *
     * @param  int|string $id  Identificador del producto
     * @return Response
     */
    public function mostrar(int|string $id): Response
    {
        return response("Producto con ID: {$id}");
    }
}