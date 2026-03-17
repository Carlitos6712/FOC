<?php

namespace App\Controller;

use App\Entity\Libro;
use App\Repository\LibroRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Controlador CRUD para la entidad Libro.
 * Cubre los ejercicios 10 al 14 de operaciones con base de datos.
 *
 * @author Carlos Vico
 */
class LibroController extends AbstractController
{
    /**
     * Ejercicio 10: Inserta un libro de ejemplo en la base de datos.
     * EntityManagerInterface es el punto central de Doctrine para persistir datos.
     */
    #[Route('/libro/insertar', name: 'app_libro_insertar')]
    public function insertar(EntityManagerInterface $em): Response
    {
        $libro = new Libro();
        $libro->setTitulo('Don Quijote');
        $libro->setAutor('Cervantes');
        $libro->setPrecio(18);

        // persist() prepara el objeto para ser guardado
        $em->persist($libro);
        // flush() ejecuta el INSERT en la BD
        $em->flush();

        return new Response('Libro insertado correctamente');
    }

    /**
     * Ejercicio 11: Muestra todos los libros almacenados en la BD.
     * findAll() evita consultas N+1 al traer todos los registros de una vez.
     */
    #[Route('/libros', name: 'app_libro_listar')]
    public function listar(LibroRepository $repo): Response
    {
        $libros = $repo->findAll();

        return $this->render('libros/listar.html.twig', [
            'libros' => $libros,
        ]);
    }

    /**
     * Ejercicio 12: Muestra un libro concreto por su ID.
     * find() devuelve null si no existe, por eso validamos antes de mostrar.
     */
    #[Route('/libro/{id}', name: 'app_libro_show')]
    public function mostrar(int $id, LibroRepository $repo): Response
    {
        $libro = $repo->find($id);

        if (!$libro) {
            return new Response("No se encontró el libro con ID: {$id}", 404);
        }

        return new Response(
            "{$libro->getTitulo()} - {$libro->getAutor()} - {$libro->getPrecio()}€"
        );
    }

    /**
     * Ejercicio 13: Actualiza el precio del libro con ID 1.
     * Se usa find() + setter + flush() sin necesidad de persist() en entidades ya gestionadas.
     */
    #[Route('/libro/actualizar/1', name: 'app_libro_actualizar')]
    public function actualizar(EntityManagerInterface $em, LibroRepository $repo): Response
    {
        $libro = $repo->find(1);

        if (!$libro) {
            return new Response('Libro no encontrado', 404);
        }

        $libro->setPrecio(22);
        $em->flush();

        return new Response('Precio actualizado correctamente');
    }

    /**
     * Ejercicio 14: Elimina el libro con ID 1 de la base de datos.
     * remove() + flush() ejecuta el DELETE en la BD.
     */
    #[Route('/libro/eliminar/1', name: 'app_libro_eliminar')]
    public function eliminar(EntityManagerInterface $em, LibroRepository $repo): Response
    {
        $libro = $repo->find(1);

        if (!$libro) {
            return new Response('Libro no encontrado', 404);
        }

        $em->remove($libro);
        $em->flush();

        return new Response('Libro eliminado correctamente');
    }
}