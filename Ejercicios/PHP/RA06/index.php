<?php
/**
 * RA06 - index.php
 *
 * Página principal: muestra cada autor con sus libros publicados.
 * Permite borrar autores y libros individualmente.
 *
 * @author  Carlos Vico
 * @version 1.0
 */
require_once __DIR__ . '/Libros.php';

// Credenciales desde variables de entorno (nunca hardcodeadas)
$servidor  = getenv('DB_HOST')     ?: 'localhost';
$baseDatos = getenv('DB_NAME')     ?: 'libros';
$usuario   = getenv('DB_USER')     ?: 'root';
$password  = getenv('DB_PASS')     ?: '';

$repo = new Libros();
$con  = $repo->conexion($servidor, $baseDatos, $usuario, $password);

$mensajeAccion = '';

// --- Borrado de autor ---
if (isset($_POST['borrar_autor'])) {
    $idAutor = (int)$_POST['id_autor'];
    $ok = $repo->borrarAutor($con, $idAutor);
    $mensajeAccion = $ok
        ? "Autor #$idAutor eliminado correctamente (y sus libros)."
        : "Error al eliminar el autor #$idAutor.";
}

// --- Borrado de libro ---
if (isset($_POST['borrar_libro'])) {
    $idLibro = (int)$_POST['id_libro'];
    $ok = $repo->borrarLibro($con, $idLibro);
    $mensajeAccion = $ok
        ? "Libro #$idLibro eliminado correctamente."
        : "Error al eliminar el libro #$idLibro.";
}

$autores = $con ? $repo->consultarAutores($con) : null;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>RA06 - Biblioteca</title>
    <style>
        body  { font-family: Arial, sans-serif; max-width: 800px; margin: 2rem auto; background: #f4f4f4; }
        h1    { background: #1a1a2e; color: #fff; padding: 1rem; border-radius: 6px; }
        .card { background: #fff; padding: 1.5rem; margin-bottom: 1.5rem; border-radius: 6px; box-shadow: 0 2px 6px rgba(0,0,0,.08); }
        table { width: 100%; border-collapse: collapse; margin-top: .8rem; }
        th    { background: #1a1a2e; color: #fff; padding: .5rem 1rem; text-align: left; }
        td    { border-bottom: 1px solid #eee; padding: .5rem 1rem; }
        .btn-del { background: #c0392b; color: #fff; border: none; padding: .3rem .7rem; cursor: pointer; border-radius: 3px; }
        .msg-ok  { color: #27a; font-weight: bold; }
        .msg-err { color: red; font-weight: bold; }
    </style>
</head>
<body>

<h1>📚 Biblioteca — RA06</h1>

<?php if ($mensajeAccion !== '') : ?>
    <p class="<?php echo str_contains($mensajeAccion, 'Error') ? 'msg-err' : 'msg-ok'; ?>">
        <?php echo htmlspecialchars($mensajeAccion); ?>
    </p>
<?php endif; ?>

<?php if ($con === null) : ?>
    <p class="msg-err">No se pudo conectar a la base de datos.</p>
<?php elseif (empty($autores)) : ?>
    <p>No hay autores en la base de datos.</p>
<?php else : ?>

    <?php foreach ($autores as $autor) : ?>
        <?php $libros = $repo->consultarLibros($con, (int)$autor['id']); ?>

        <div class="card">
            <h2>
                <?php echo htmlspecialchars($autor['nombre'] . ' ' . $autor['apellidos']); ?>
                <small>(<?php echo htmlspecialchars($autor['nacionalidad']); ?>)</small>
            </h2>

            <!-- Botón para borrar autor (borra también sus libros por CASCADE) -->
            <form method="POST" style="display:inline"
                  onsubmit="return confirm('¿Borrar autor y todos sus libros?')">
                <input type="hidden" name="id_autor" value="<?php echo $autor['id']; ?>">
                <button class="btn-del" name="borrar_autor">Borrar autor</button>
            </form>

            <h3>Libros publicados</h3>

            <?php if (empty($libros)) : ?>
                <p>Sin libros registrados.</p>
            <?php else : ?>
                <table>
                    <thead>
                        <tr><th>ID</th><th>Título</th><th>Publicación</th><th>Acción</th></tr>
                    </thead>
                    <tbody>
                        <?php foreach ($libros as $libro) : ?>
                            <tr>
                                <td><?php echo $libro['id']; ?></td>
                                <td><?php echo htmlspecialchars($libro['titulo']); ?></td>
                                <td><?php echo htmlspecialchars($libro['f_publicacion']); ?></td>
                                <td>
                                    <form method="POST"
                                          onsubmit="return confirm('¿Borrar este libro?')">
                                        <input type="hidden" name="id_libro"
                                               value="<?php echo $libro['id']; ?>">
                                        <button class="btn-del" name="borrar_libro">Borrar</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>

    <?php endforeach; ?>

<?php endif; ?>

</body>
</html>
