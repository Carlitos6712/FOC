<?php
/**
 * RA07 - api.php
 *
 * API REST que expone datos de la BD Libros en formato JSON estándar.
 * Responde siempre con { success, data, message }.
 *
 * Rutas soportadas (parámetro GET "action"):
 *   - get_listado_autores
 *   - get_datos_autor&id=N
 *   - get_listado_libros
 *   - get_datos_libro&id=N
 *
 * @author  Carlos Vico
 * @version 1.0
 */
require_once __DIR__ . '/../RA06/Libros.php';

header('Content-Type: application/json; charset=utf-8');
// CORS básico para consumo desde cliente en mismo servidor
header('Access-Control-Allow-Origin: *');

$servidor  = getenv('DB_HOST') ?: 'localhost';
$baseDatos = getenv('DB_NAME') ?: 'libros';
$usuario   = getenv('DB_USER') ?: 'root';
$password  = getenv('DB_PASS') ?: '';

$repo = new Libros();
$con  = $repo->conexion($servidor, $baseDatos, $usuario, $password);

/** @var string[] URLs/acciones válidas aceptadas por la API */
$posiblesURL = [
    'get_listado_autores',
    'get_datos_autor',
    'get_listado_libros',
    'get_datos_libro',
];

/**
 * Emite una respuesta JSON estándar y termina la ejecución.
 *
 * @param bool   $success  Resultado de la operación.
 * @param mixed  $data     Datos a devolver.
 * @param string $message  Mensaje descriptivo.
 * @param int    $httpCode Código HTTP de respuesta.
 * @return never
 */
function responder(bool $success, mixed $data, string $message, int $httpCode = 200): never
{
    http_response_code($httpCode);
    echo json_encode(
        ['success' => $success, 'data' => $data, 'message' => $message],
        JSON_UNESCAPED_UNICODE
    );
    exit;
}

// Validar conexión
if ($con === null) {
    responder(false, null, 'Error de conexión a la base de datos.', 500);
}

$action = $_GET['action'] ?? '';

if (!in_array($action, $posiblesURL, true)) {
    responder(false, null, "Acción '$action' no reconocida.", 400);
}

switch ($action) {

    // ------------------------------------------------------------------
    case 'get_listado_autores':
        /**
         * Devuelve todos los autores.
         *
         * @return array[] Lista de autores {id, nombre, apellidos, nacionalidad}.
         */
        $autores = $repo->consultarAutores($con);
        if ($autores === null) {
            responder(false, null, 'Error al consultar autores.', 500);
        }
        responder(true, $autores, 'Listado de autores obtenido.');

    // ------------------------------------------------------------------
    case 'get_datos_autor':
        /**
         * Devuelve los datos de un autor y sus libros.
         *
         * @param int $id ID del autor.
         * @return array  Datos del autor + array de libros.
         */
        $id = isset($_GET['id']) ? (int)$_GET['id'] : null;

        if ($id === null) {
            responder(false, null, 'Parámetro id requerido.', 400);
        }

        $autores = $repo->consultarAutores($con, $id);

        if (empty($autores)) {
            responder(false, null, "Autor #$id no encontrado.", 404);
        }

        $autor         = $autores[0];
        $autor['libros'] = $repo->consultarLibros($con, $id) ?? [];

        responder(true, $autor, 'Datos del autor obtenidos.');

    // ------------------------------------------------------------------
    case 'get_listado_libros':
        /**
         * Devuelve todos los libros (id y título).
         *
         * @return array[] Lista [{id, titulo}].
         */
        $libros = $repo->consultarLibros($con);

        if ($libros === null) {
            responder(false, null, 'Error al consultar libros.', 500);
        }

        // Proyectamos solo id y titulo según el enunciado
        $resultado = array_map(
            fn($l) => ['id' => $l['id'], 'titulo' => $l['titulo']],
            $libros
        );

        responder(true, $resultado, 'Listado de libros obtenido.');

    // ------------------------------------------------------------------
    case 'get_datos_libro':
        /**
         * Devuelve datos completos de un libro + nombre del autor.
         *
         * @param int $id ID del libro.
         * @return array  {titulo, f_publicacion, id_autor, nombre, apellidos}.
         */
        $id = isset($_GET['id']) ? (int)$_GET['id'] : null;

        if ($id === null) {
            responder(false, null, 'Parámetro id requerido.', 400);
        }

        $libro = $repo->consultarDatosLibro($con, $id);

        if ($libro === null) {
            responder(false, null, "Libro #$id no encontrado.", 404);
        }

        // Eager loading del autor para evitar N+1
        $autores = $repo->consultarAutores($con, (int)$libro['id_autor']);
        $autor   = $autores[0] ?? ['nombre' => '', 'apellidos' => ''];

        $libro['nombre']    = $autor['nombre'];
        $libro['apellidos'] = $autor['apellidos'];

        responder(true, $libro, 'Datos del libro obtenidos.');
}
