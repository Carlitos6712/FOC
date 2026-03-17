<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Controlador para la gestión de productos.
 *
 * @author Carlos Vico
 */
class ProductoController extends AbstractController
{
    /**
     * Ejercicio 4: Lista todos los productos.
     * En producción esto vendría del repositorio de BD.
     */
    #[Route('/productos', name: 'app_productos')]
    public function listar(): Response
    {
        return new Response('Listado de productos');
    }

    /**
     * Ejercicio 5: Muestra un producto concreto por su ID.
     * El tipo int fuerza que Symfony valide que sea numérico.
     *
     * @param int $id Identificador del producto
     */
    #[Route('/producto/{id}', name: 'app_producto_show')]
    public function mostrar(int $id): Response
    {
        return new Response("Mostrando producto con ID: {$id}");
    }
}