<?php
/**
 * RA04 / RA4_c - sesion.php
 *
 * Gestiona teléfono, email en sesión y horario en cookie.
 * Redirige a login.php si no hay sesión activa.
 *
 * @author  Carlos Vico
 * @version 1.0
 */
session_start();

// Sin sesión de usuario → redirige al login
if (empty($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}

$mensajeAccion = '';

// --- Botón Grabar datos de sesión ---
if (isset($_POST['grabar'])) {
    $telefono = trim($_POST['telefono'] ?? '');
    $email    = trim($_POST['email']    ?? '');

    if ($telefono === '' || $email === '') {
        $mensajeAccion = 'Ambos campos son requeridos.';
    } else {
        $_SESSION['telefono'] = $telefono;
        $_SESSION['email']    = $email;
        $mensajeAccion = 'Datos guardados en sesión.';
    }
}

// --- Botón Grabar horario (cookie) ---
if (isset($_POST['grabar_horario'])) {
    $horario = $_POST['horario'] ?? 'Mañana';
    // Cookie válida 30 días; httponly protege contra lectura JS
    setcookie('horario', $horario, time() + 30 * 86400, '/', '', false, true);
    $_COOKIE['horario'] = $horario; // actualizar para la vista inmediata
    $mensajeAccion = 'Horario guardado en cookie.';
}

// --- Botón Borrar sesión y cookie ---
if (isset($_POST['borrar'])) {
    session_destroy();
    // Borrar cookie poniendo fecha en el pasado
    setcookie('horario', '', time() - 3600, '/');
    header('Location: login.php');
    exit;
}

// Valores actuales (de sesión o vacíos)
$telefono       = $_SESSION['telefono'] ?? '';
$email          = $_SESSION['email']    ?? '';
$horarioActual  = $_COOKIE['horario']   ?? '';
$opcionesHorario = ['Mañana', 'Tarde', 'Noche'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>RA04 - Sesión</title>
    <style>
        body  { font-family: Arial, sans-serif; max-width: 480px; margin: 2rem auto; background: #f4f4f4; }
        label { display: block; margin-top: .8rem; }
        input, select { width: 100%; padding: .5rem; box-sizing: border-box; margin-top: .3rem; }
        button { padding: .5rem 1rem; background: #333; color: #fff; border: none; cursor: pointer; margin-top: .5rem; margin-right: .4rem; }
        .msg  { color: #27a; margin-top: .8rem; font-weight: bold; }
    </style>
</head>
<body>

<h1>Gestión de sesión</h1>
<p>Usuario: <strong><?php echo htmlspecialchars($_SESSION['usuario'] ?? ''); ?></strong></p>

<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">

    <label>Teléfono
        <input type="tel" name="telefono" value="<?php echo htmlspecialchars($telefono); ?>">
    </label>

    <label>Email
        <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>">
    </label>

    <button name="grabar">Grabar</button>
    <button name="borrar" onclick="return confirm('¿Borrar sesión y cookie?')">Borrar</button>
</form>

<hr>

<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
    <label>Horario preferido
        <select name="horario">
            <?php foreach ($opcionesHorario as $op) : ?>
                <option value="<?php echo $op; ?>"
                    <?php echo ($horarioActual === $op) ? 'selected' : ''; ?>>
                    <?php echo $op; ?>
                </option>
            <?php endforeach; ?>
        </select>
    </label>
    <button name="grabar_horario">Grabar horario</button>
</form>

<?php if ($mensajeAccion !== '') : ?>
    <p class="msg"><?php echo htmlspecialchars($mensajeAccion); ?></p>
<?php endif; ?>

</body>
</html>
