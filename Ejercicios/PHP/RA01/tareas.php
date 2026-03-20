<?php
/**
 * RA01_f - Gestión de tareas almacenadas en archivo de texto
 *
 * Demuestra la integración HTML + PHP para generar contenido dinámico
 * leyendo y escribiendo en un fichero plano.
 *
 * @author  Carlos Vico
 * @version 1.0
 */

/** @var string Ruta al fichero de tareas */
const TAREAS_FILE = __DIR__ . '/tareas.txt';

/**
 * Carga las tareas desde el fichero de texto.
 *
 * @return string[] Array de tareas (una por línea).
 */
function cargarTareas(): array
{
    if (!file_exists(TAREAS_FILE)) {
        return [];
    }

    // file() lee línea a línea; FILE_IGNORE_NEW_LINES elimina saltos
    $lineas = file(TAREAS_FILE, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    return $lineas !== false ? $lineas : [];
}

/**
 * Añade una nueva tarea al fichero.
 *
 * @param string $tarea Texto de la tarea a añadir.
 * @return bool true si se guardó correctamente, false en caso contrario.
 */
function agregarTarea(string $tarea): bool
{
    $tarea = trim($tarea);

    if ($tarea === '') {
        return false;
    }

    // FILE_APPEND evita sobreescribir; LOCK_EX bloqueo exclusivo para evitar race conditions
    return file_put_contents(TAREAS_FILE, $tarea . PHP_EOL, FILE_APPEND | LOCK_EX) !== false;
}

// --- Procesamiento del formulario ---
$error   = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nueva = $_POST['tarea'] ?? '';

    if (trim($nueva) === '') {
        $error = 'La tarea no puede estar vacía.';
    } elseif (!agregarTarea($nueva)) {
        $error = 'No se pudo guardar la tarea. Verifica los permisos del directorio.';
    } else {
        $success = 'Tarea añadida correctamente.';
    }
}

$tareas = cargarTareas();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>RA01_f - Lista de Tareas</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 640px; margin: 2rem auto; background: #f4f4f4; }
        h1   { color: #333; }
        input[type="text"] { width: 70%; padding: .5rem; }
        button { padding: .5rem 1rem; background: #333; color: #fff; border: none; cursor: pointer; }
        ul   { background: #fff; padding: 1.5rem 2rem; border-radius: 6px; }
        li   { margin: .4rem 0; }
        .msg-ok  { color: green; }
        .msg-err { color: red; }
    </style>
</head>
<body>

<h1>Lista de Tareas</h1>

<!-- Formulario POST: el servidor procesa el dato y recarga la página -->
<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
    <input type="text" name="tarea" placeholder="Nueva tarea..." required>
    <button type="submit">Añadir</button>
</form>

<?php if ($error !== '')   : ?><p class="msg-err"><?php echo htmlspecialchars($error); ?></p><?php endif; ?>
<?php if ($success !== '') : ?><p class="msg-ok"><?php echo htmlspecialchars($success); ?></p><?php endif; ?>

<h2>Tareas guardadas</h2>

<?php if (empty($tareas)) : ?>
    <p>No hay tareas todavía.</p>
<?php else : ?>
    <ul>
        <?php foreach ($tareas as $t) : ?>
            <li><?php echo htmlspecialchars($t); ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

</body>
</html>
