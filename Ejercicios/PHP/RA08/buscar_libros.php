<?php
/**
 * RA08 - buscar_libros.php
 *
 * Endpoint AJAX que busca libros por título usando LIKE.
 * Devuelve JSON estándar { success, data, message }.
 *
 * @author  Carlos Vico
 * @version 1.0
 */
require_once __DIR__ . '/../RA06/Libros.php';

header('Content-Type: application/json; charset=utf-8');

$servidor  = getenv('DB_HOST') ?: 'localhost';
$baseDatos = getenv('DB_NAME') ?: 'libros';
$usuario   = getenv('DB_USER') ?: 'root';
$password  = getenv('DB_PASS') ?: '';

/**
 * Emite respuesta JSON y termina.
 *
 * @param bool   $success Estado de la operación.
 * @param mixed  $data    Datos a incluir.
 * @param string $message Mensaje descriptivo.
 * @return never
 */
function responder(bool $success, mixed $data, string $message): never
{
    echo json_encode(
        ['success' => $success, 'data' => $data, 'message' => $message],
        JSON_UNESCAPED_UNICODE
    );
    exit;
}

$query = trim($_GET['q'] ?? '');

// Validación: solo letras, espacios y puntuación básica (refleja la validación JS)
if (!preg_match('/^[A-Za-záéíóúÁÉÍÓÚüÜñÑ\s,.]*$/u', $query)) {
    responder(false, [], 'Caracteres no permitidos en la búsqueda.');
}

if ($query === '') {
    responder(true, [], 'Sin resultados.');
}

$repo = new Libros();
$con  = $repo->conexion($servidor, $baseDatos, $usuario, $password);

if ($con === null) {
    responder(false, [], 'Error de conexión.');
}

try {
    // JOIN para recuperar autor en una sola consulta (evita N+1)
    $stmt = $con->prepare(
        'SELECT l.id, l.titulo, l.f_publicacion, a.nombre, a.apellidos
         FROM libros l
         INNER JOIN autores a ON a.id = l.id_autor
         WHERE l.titulo LIKE :q
         ORDER BY l.titulo'
    );

    $stmt->execute([':q' => "%$query%"]);
    $libros = $stmt->fetchAll();

    responder(true, $libros, 'Búsqueda completada.');
} catch (PDOException $e) {
    error_log('buscar_libros - ' . $e->getMessage());
    responder(false, [], 'Error al ejecutar la búsqueda.');
}
