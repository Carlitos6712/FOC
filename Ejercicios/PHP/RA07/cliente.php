<?php
/**
 * RA07 - cliente.php
 *
 * Cliente web que consume la API REST local y presenta los datos
 * con maquetación HTML. Permite navegar por autores y libros.
 *
 * @author  Carlos Vico
 * @version 1.0
 */

/** @var string URL base de la API */
const API_BASE = 'http://localhost/dwes/RA07/api.php';

/**
 * Realiza una petición GET a la API y devuelve el campo `data`.
 *
 * @param string $action  Nombre de la acción a invocar.
 * @param array  $params  Parámetros adicionales de query string.
 * @return mixed          Datos decodificados o null si hay error.
 */
function llamarApi(string $action, array $params = []): mixed
{
    $query = http_build_query(array_merge(['action' => $action], $params));
    $url   = API_BASE . '?' . $query;

    $json = @file_get_contents($url);

    if ($json === false) {
        return null;
    }

    $respuesta = json_decode($json, true);

    return ($respuesta['success'] ?? false) ? $respuesta['data'] : null;
}

// Determinar qué pantalla mostrar según el parámetro action
$action   = $_GET['action']   ?? 'get_listado_autores';
$idParam  = isset($_GET['id']) ? (int)$_GET['id'] : null;

$titulo   = 'Biblioteca';
$contenido = '';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>RA07 - Cliente API</title>
    <style>
        * { box-sizing: border-box; }
        body  { font-family: 'Segoe UI', Arial, sans-serif; margin: 0; background: #f0f2f5; color: #222; }
        header { background: #1a1a2e; color: #fff; padding: 1rem 2rem; display: flex; gap: 2rem; align-items: center; }
        header h1 { margin: 0; font-size: 1.3rem; }
        nav a  { color: #aad4f5; text-decoration: none; margin-right: 1.2rem; }
        nav a:hover { text-decoration: underline; }
        main  { max-width: 860px; margin: 2rem auto; padding: 0 1rem; }
        .card { background: #fff; border-radius: 8px; padding: 1.5rem; margin-bottom: 1rem; box-shadow: 0 2px 6px rgba(0,0,0,.08); }
        table { width: 100%; border-collapse: collapse; margin-top: .8rem; }
        th    { background: #1a1a2e; color: #fff; padding: .6rem 1rem; text-align: left; }
        td    { border-bottom: 1px solid #eee; padding: .6rem 1rem; }
        a.enlace { color: #1a6eb5; text-decoration: none; }
        a.enlace:hover { text-decoration: underline; }
        footer { text-align: center; color: #888; font-size: .85rem; padding: 1rem; }
    </style>
</head>
<body>

<header>
    <h1>📚 Biblioteca &mdash; RA07</h1>
    <nav>
        <a href="?action=get_listado_autores">Autores</a>
        <a href="?action=get_listado_libros">Libros</a>
    </nav>
</header>

<main>

<?php

// ================================================================
// LISTADO DE AUTORES
// ================================================================
if ($action === 'get_listado_autores') :
    $autores = llamarApi('get_listado_autores');
?>
    <div class="card">
        <h2>Listado de autores</h2>
        <?php if (empty($autores)) : ?>
            <p>No hay autores disponibles.</p>
        <?php else : ?>
            <table>
                <thead><tr><th>ID</th><th>Nombre</th><th>Apellidos</th><th>Nacionalidad</th></tr></thead>
                <tbody>
                    <?php foreach ($autores as $a) : ?>
                        <tr>
                            <td><?php echo $a['id']; ?></td>
                            <td>
                                <a class="enlace"
                                   href="?action=get_datos_autor&id=<?php echo $a['id']; ?>">
                                    <?php echo htmlspecialchars($a['nombre']); ?>
                                </a>
                            </td>
                            <td><?php echo htmlspecialchars($a['apellidos']); ?></td>
                            <td><?php echo htmlspecialchars($a['nacionalidad']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>

<?php
// ================================================================
// DETALLE DE AUTOR (con lista de libros)
// ================================================================
elseif ($action === 'get_datos_autor' && $idParam !== null) :
    $autor = llamarApi('get_datos_autor', ['id' => $idParam]);
?>
    <div class="card">
        <p><a class="enlace" href="?action=get_listado_autores">&larr; Volver a autores</a></p>
        <?php if ($autor === null) : ?>
            <p>Autor no encontrado.</p>
        <?php else : ?>
            <h2><?php echo htmlspecialchars($autor['nombre'] . ' ' . $autor['apellidos']); ?></h2>
            <p><strong>Nacionalidad:</strong> <?php echo htmlspecialchars($autor['nacionalidad']); ?></p>

            <h3>Libros publicados</h3>
            <?php if (empty($autor['libros'])) : ?>
                <p>Sin libros registrados.</p>
            <?php else : ?>
                <ul>
                    <?php foreach ($autor['libros'] as $libro) : ?>
                        <li>
                            <a class="enlace"
                               href="?action=get_datos_libro&id=<?php echo $libro['id']; ?>">
                                <?php echo htmlspecialchars($libro['titulo']); ?>
                            </a>
                            (<?php echo htmlspecialchars($libro['f_publicacion']); ?>)
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        <?php endif; ?>
    </div>

<?php
// ================================================================
// LISTADO DE LIBROS
// ================================================================
elseif ($action === 'get_listado_libros') :
    $libros = llamarApi('get_listado_libros');
?>
    <div class="card">
        <h2>Listado de libros</h2>
        <?php if (empty($libros)) : ?>
            <p>No hay libros disponibles.</p>
        <?php else : ?>
            <table>
                <thead><tr><th>ID</th><th>Título</th></tr></thead>
                <tbody>
                    <?php foreach ($libros as $l) : ?>
                        <tr>
                            <td><?php echo $l['id']; ?></td>
                            <td>
                                <a class="enlace"
                                   href="?action=get_datos_libro&id=<?php echo $l['id']; ?>">
                                    <?php echo htmlspecialchars($l['titulo']); ?>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>

<?php
// ================================================================
// DETALLE DE LIBRO (con enlace al autor)
// ================================================================
elseif ($action === 'get_datos_libro' && $idParam !== null) :
    $libro = llamarApi('get_datos_libro', ['id' => $idParam]);
?>
    <div class="card">
        <p><a class="enlace" href="?action=get_listado_libros">&larr; Volver a libros</a></p>
        <?php if ($libro === null) : ?>
            <p>Libro no encontrado.</p>
        <?php else : ?>
            <h2><?php echo htmlspecialchars($libro['titulo']); ?></h2>
            <p><strong>Fecha de publicación:</strong> <?php echo htmlspecialchars($libro['f_publicacion']); ?></p>
            <p>
                <strong>Autor:</strong>
                <a class="enlace"
                   href="?action=get_datos_autor&id=<?php echo $libro['id_autor']; ?>">
                    <?php echo htmlspecialchars($libro['nombre'] . ' ' . $libro['apellidos']); ?>
                </a>
            </p>
        <?php endif; ?>
    </div>

<?php else : ?>
    <p>Acción no reconocida.</p>
<?php endif; ?>

</main>

<footer>Carlos Vico &mdash; RA07 &mdash; <?php echo date('Y'); ?></footer>

</body>
</html>
