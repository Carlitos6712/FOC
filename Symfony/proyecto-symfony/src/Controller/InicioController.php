<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Controlador de inicio de la aplicación.
 *
 * @author Carlos Vico
 */
class InicioController extends AbstractController
{
    /**
     * Muestra el mensaje de bienvenida principal.
     * Punto de entrada básico para verificar que el routing funciona.
     */
    #[Route('/inicio', name: 'app_inicio')]
    public function index(): Response
    {
        return new Response('Bienvenido a mi primera aplicación Symfony');
    }

    /**
     * Saluda al usuario por su nombre recibido por URL.
     *
     * @param string $nombre Nombre recibido como parámetro de ruta
     */
    #[Route('/saludo/{nombre}', name: 'app_saludo')]
    public function saludo(string $nombre): Response
    {
        return new Response("Hola {$nombre}, bienvenido a Symfony");
    }

    /**
     * Multiplica dos números recibidos por URL.
     * Se validan como enteros para evitar operaciones con strings.
     *
     * @param int $num1 Primer operando
     * @param int $num2 Segundo operando
     */
    #[Route('/multiplicar/{num1}/{num2}', name: 'app_multiplicar')]
    public function multiplicar(int $num1, int $num2): Response
    {
        $resultado = $num1 * $num2;

        return new Response("El resultado es: {$resultado}");
    }

    /**
     * Ejercicio 6 y 7: Carga la vista Twig y le pasa el nombre.
     * AbstractController::render() gestiona el renderizado de plantillas.
     */
    #[Route('/bienvenida', name: 'app_bienvenida')]
    public function bienvenida(): Response
    {
        // Ejercicio 7: variable pasada a la vista
        $nombre = 'Carlos';

        return $this->render('bienvenida.html.twig', [
            'nombre' => $nombre,
        ]);
    }

    /**
     * Ejercicio 8: Pasa un array a la vista y lo itera con Twig.
     */
    #[Route('/ciudades', name: 'app_ciudades')]
    public function ciudades(): Response
    {
        $ciudades = ['Granada', 'Madrid', 'Sevilla', 'Valencia'];

        return $this->render('ciudades.html.twig', [
            'ciudades' => $ciudades,
        ]);
    }
}
