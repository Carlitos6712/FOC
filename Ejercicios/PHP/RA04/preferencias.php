<?php
/**
 * RA04_a - Contador de visitas por sesión
 * RA04_b - Preferencias de tema guardadas en cookie
 *
 * @author  Carlos Vico
 * @version 1.0
 */
session_start();

// --- RA04_a: Contador de visitas ---
// Si es la primera visita inicializamos; si no, incrementamos
if (!isset($_SESSION['visitas'])) {
    $_SESSION['visitas'] = 1;
} else {
    $_SESSION['visitas']++;
}

// --- RA04_b: Cookie de tema ---
$temasPosibles = ['claro', 'oscuro'];
$temaActual    = $_COOKIE['tema'] ?? 'claro';

if (isset($_POST['tema']) && in_array($_POST['tema'], $temasPosibles, true)) {
    $temaActual = $_POST['tema'];
    // Una semana de duración; httponly protege ante acceso JS
    setcookie('tema', $temaActual, time() + 7 * 86400, '/', '', false, true);
}

// Colores según tema
$estilos = [
    'claro'  => ['bg' => '#ffffff', 'text' => '#222222'],
    'oscuro' => ['bg' => '#1e1e1e', 'text' => '#f0f0f0'],
];
$estilo = $estilos[$temaActual];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>RA04 - Visitas y Tema</title>
    <style>
        body   { font-family: Arial, sans-serif; max-width: 480px; margin: 3rem auto;
                 background: <?php echo $estilo['bg']; ?>; color: <?php echo $estilo['text']; ?>; }
        button { padding: .5rem 1rem; margin: .3rem; cursor: pointer; border: 1px solid #888; }
    </style>
</head>
<body>

<h1>RA04_a - Contador de visitas</h1>
<p>Has visitado esta página <strong><?php echo $_SESSION['visitas']; ?></strong> vez/veces en esta sesión.</p>

<hr>

<h1>RA04_b - Preferencias de tema</h1>
<p>Tema actual: <strong><?php echo htmlspecialchars($temaActual); ?></strong></p>

<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
    <button name="tema" value="claro">☀️ Tema Claro</button>
    <button name="tema" value="oscuro">🌙 Tema Oscuro</button>
</form>

</body>
</html>
