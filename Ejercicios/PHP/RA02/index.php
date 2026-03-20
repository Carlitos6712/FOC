<?php
/**
 * RA02_A - Página dinámica con fecha y saludo personalizado
 *
 * @author  Carlos Vico
 * @version 1.0
 */

// Captura segura del nombre enviado por POST
$nombre  = trim($_POST['nombre'] ?? '');
$saludo  = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $nombre !== '') {
    // htmlspecialchars previene XSS al reflejar datos del usuario
    $saludo = 'Hola, ' . htmlspecialchars($nombre) . '!';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>RA02_A - Saludo</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 480px; margin: 2rem auto; }
        input, button { padding: .5rem; margin-top: .5rem; }
        .saludo { font-size: 1.4rem; color: #2a7; margin-top: 1rem; }
    </style>
</head>
<body>

<!-- Fecha generada dinámicamente por PHP en cada carga -->
<p><strong>Fecha actual:</strong> <?php echo date('Y-m-d'); ?></p>

<h2>¿Cómo te llamas?</h2>

<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
    <input type="text" name="nombre" placeholder="Tu nombre" required>
    <br>
    <button type="submit">Saludar</button>
</form>

<?php if ($saludo !== '') : ?>
    <p class="saludo"><?php echo $saludo; ?></p>
<?php endif; ?>

</body>
</html>
