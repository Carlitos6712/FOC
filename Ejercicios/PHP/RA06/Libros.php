<?php
/**
 * RA06 - Clase Libros
 *
 * Gestiona la conexión y las consultas sobre la base de datos Libros.
 * Implementa acceso a autores y libros con métodos de lectura y borrado.
 *
 * @author  Carlos Vico
 * @version 1.0
 */
class Libros
{
    /**
     * Establece y devuelve una conexión PDO a la base de datos.
     *
     * Se usa PDO en lugar de mysqli para mayor portabilidad y
     * soporte nativo de prepared statements.
     *
     * @param string $servidor   Nombre o IP del servidor de base de datos.
     * @param string $baseDatos  Nombre de la base de datos.
     * @param string $usuario    Usuario de conexión.
     * @param string $password   Contraseña (debe venir de variables de entorno).
     * @return PDO|null          Objeto de conexión o null si falla.
     */
    public function conexion(
        string $servidor,
        string $baseDatos,
        string $usuario,
        string $password
    ): ?PDO {
        try {
            $dsn = "mysql:host=$servidor;dbname=$baseDatos;charset=utf8mb4";

            $pdo = new PDO($dsn, $usuario, $password, [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ]);

            return $pdo;
        } catch (PDOException $e) {
            // Registramos el error sin exponer credenciales al exterior
            error_log('Libros::conexion - ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Consulta uno o todos los autores de la base de datos.
     *
     * @param PDO      $conexion  Objeto de conexión activo.
     * @param int|null $idAutor   ID del autor o null para obtener todos.
     * @return array[]|null       Array de filas de autores o null si hay error.
     */
    public function consultarAutores(PDO $conexion, ?int $idAutor = null): ?array
    {
        try {
            if ($idAutor !== null) {
                $stmt = $conexion->prepare(
                    'SELECT id, nombre, apellidos, nacionalidad FROM autores WHERE id = :id'
                );
                $stmt->execute([':id' => $idAutor]);
            } else {
                $stmt = $conexion->query(
                    'SELECT id, nombre, apellidos, nacionalidad FROM autores ORDER BY id'
                );
            }

            return $stmt->fetchAll();
        } catch (PDOException $e) {
            error_log('Libros::consultarAutores - ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Consulta los libros de un autor concreto o todos los libros.
     *
     * @param PDO      $conexion  Objeto de conexión activo.
     * @param int|null $idAutor   ID del autor o null para obtener todos los libros.
     * @return array[]|null       Array de filas de libros o null si hay error.
     */
    public function consultarLibros(PDO $conexion, ?int $idAutor = null): ?array
    {
        try {
            if ($idAutor !== null) {
                $stmt = $conexion->prepare(
                    'SELECT id, titulo, f_publicacion, id_autor
                     FROM libros
                     WHERE id_autor = :id_autor
                     ORDER BY id'
                );
                $stmt->execute([':id_autor' => $idAutor]);
            } else {
                $stmt = $conexion->query(
                    'SELECT id, titulo, f_publicacion, id_autor FROM libros ORDER BY id'
                );
            }

            return $stmt->fetchAll();
        } catch (PDOException $e) {
            error_log('Libros::consultarLibros - ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Devuelve los datos completos de un libro por su ID.
     *
     * @param PDO $conexion  Objeto de conexión activo.
     * @param int $idLibro   ID del libro a consultar.
     * @return array|null    Fila del libro o null si no existe / hay error.
     */
    public function consultarDatosLibro(PDO $conexion, int $idLibro): ?array
    {
        try {
            $stmt = $conexion->prepare(
                'SELECT id, titulo, f_publicacion, id_autor
                 FROM libros
                 WHERE id = :id'
            );
            $stmt->execute([':id' => $idLibro]);

            $resultado = $stmt->fetch();

            // fetch() devuelve false si no hay filas; normalizamos a null
            return $resultado !== false ? $resultado : null;
        } catch (PDOException $e) {
            error_log('Libros::consultarDatosLibro - ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Elimina un autor de la base de datos por su ID.
     *
     * La FK con ON DELETE CASCADE elimina también sus libros asociados.
     *
     * @param PDO $conexion  Objeto de conexión activo.
     * @param int $idAutor   ID del autor a eliminar.
     * @return bool          true si se eliminó al menos una fila, false si hubo error.
     */
    public function borrarAutor(PDO $conexion, int $idAutor): bool
    {
        try {
            $stmt = $conexion->prepare('DELETE FROM autores WHERE id = :id');
            $stmt->execute([':id' => $idAutor]);

            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            error_log('Libros::borrarAutor - ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Elimina un libro de la base de datos por su ID.
     *
     * @param PDO $conexion  Objeto de conexión activo.
     * @param int $idLibro   ID del libro a eliminar.
     * @return bool          true si se eliminó al menos una fila, false si hubo error.
     */
    public function borrarLibro(PDO $conexion, int $idLibro): bool
    {
        try {
            $stmt = $conexion->prepare('DELETE FROM libros WHERE id = :id');
            $stmt->execute([':id' => $idLibro]);

            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            error_log('Libros::borrarLibro - ' . $e->getMessage());
            return false;
        }
    }
}
