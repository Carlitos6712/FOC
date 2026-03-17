<?php

namespace App\Controller;

use App\Entity\Pelicula;
use App\Repository\PeliculaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Controlador CRUD para la gestión de películas.
 * Ejercicio final: cubre insertar, listar, mostrar, actualizar y eliminar.
 *
 * @author Carlos Vico
 */
class PeliculaController extends AbstractController
{
    /**
     * Inserta una película de ejemplo en la base de datos.
     * persist() registra el objeto en Doctrine, flush() ejecuta el INSERT.
     *
     * @param EntityManagerInterface $em Gestor de entidades de Doctrine
     */
    #[Route('/pelicula/insertar', name: 'app_pelicula_insertar')]
    public function insertar(EntityManagerInterface $em): Response
    {
        $pelicula = new Pelicula();
        $pelicula->setTitulo('El Padrino');
        $pelicula->setDirector('Francis Ford Coppola');
        $pelicula->setAnyo(1972);

        $em->persist($pelicula);
        $em->flush();

        return new Response('Película insertada correctamente');
    }

    /**
     * Lista todas las películas almacenadas en la BD.
     * findAll() trae todos los registros en una sola consulta.
     *
     * @param PeliculaRepository $repo Repositorio inyectado por Symfony
     */
    #[Route('/peliculas', name: 'app_pelicula_listar')]
    public function listar(PeliculaRepository $repo): Response
    {
        $peliculas = $repo->findAll();

        return $this->render('peliculas/listar.html.twig', [
            'peliculas' => $peliculas,
        ]);
    }

    /**
     * Muestra el detalle de una película por su ID.
     * El requirement '\d+' evita que rutas como /pelicula/insertar colisionen.
     *
     * @param int                $id   ID recibido por la URL
     * @param PeliculaRepository $repo Repositorio de películas
     */
    #[Route('/pelicula/{id}', name: 'app_pelicula_show', requirements: ['id' => '\d+'])]
    public function mostrar(int $id, PeliculaRepository $repo): Response
    {
        $pelicula = $repo->find($id);

        if (!$pelicula) {
            return new Response("No se encontró la película con ID: {$id}", 404);
        }

        return $this->render('peliculas/detalle.html.twig', [
            'pelicula' => $pelicula,
        ]);
    }

    /**
     * Actualiza el título de la película con ID 1.
     * Doctrine detecta cambios automáticamente (Change Tracking), solo necesita flush().
     *
     * @param EntityManagerInterface $em   Gestor de entidades
     * @param PeliculaRepository     $repo Repositorio de películas
     */
    #[Route('/pelicula/actualizar/1', name: 'app_pelicula_actualizar')]
    public function actualizar(EntityManagerInterface $em, PeliculaRepository $repo): Response
    {
        $pelicula = $repo->find(1);

        if (!$pelicula) {
            return new Response('Película no encontrada', 404);
        }

        $pelicula->setTitulo('El Padrino (Edición Restaurada)');
        $em->flush();

        return new Response('Título actualizado correctamente');
    }

    /**
     * Elimina la película con ID 1 de la base de datos.
     * remove() marca la entidad para borrado, flush() ejecuta el DELETE.
     *
     * @param EntityManagerInterface $em   Gestor de entidades
     * @param PeliculaRepository     $repo Repositorio de películas
     */
    #[Route('/pelicula/eliminar/1', name: 'app_pelicula_eliminar')]
    public function eliminar(EntityManagerInterface $em, PeliculaRepository $repo): Response
    {
        $pelicula = $repo->find(1);

        if (!$pelicula) {
            return new Response('Película no encontrada', 404);
        }

        $em->remove($pelicula);
        $em->flush();

        return new Response('Película eliminada correctamente');
    }
}