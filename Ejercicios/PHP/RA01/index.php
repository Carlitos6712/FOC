<?php
/**
 * RA01_c - Página con información del servidor XAMPP
 *
 * @author  Carlos Vico
 * @version 1.0
 */
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>RA01 - Info Servidor</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 2rem; background: #f4f4f4; }
        header, footer { background: #333; color: #fff; padding: 1rem; text-align: center; }
        main { background: #fff; padding: 1.5rem; margin: 1rem 0; border-radius: 6px; }
        table { border-collapse: collapse; width: 100%; }
        td, th { border: 1px solid #ccc; padding: .5rem 1rem; }
        th { background: #333; color: #fff; }
    </style>
</head>
<body>

<header>
    <h1>RA01 - Servidor Web con PHP</h1>
    <p>Carlos Vico &mdash; 12345678A</p>
</header>

<main>
    <h2>Información del servidor</h2>
    <table>
        <tr><th>Parámetro</th><th>Valor</th></tr>
        <tr>
            <td>Software del servidor</td>
            <!-- $_SERVER expone variables del entorno del servidor web -->
            <td><?php echo htmlspecialchars($_SERVER['SERVER_SOFTWARE'] ?? 'No disponible'); ?></td>
        </tr>
        <tr>
            <td>Raíz del documento</td>
            <td><?php echo htmlspecialchars($_SERVER['DOCUMENT_ROOT'] ?? 'No disponible'); ?></td>
        </tr>
        <tr>
            <td>Versión PHP</td>
            <td><?php echo phpversion(); ?></td>
        </tr>
        <tr>
            <td>Sistema operativo</td>
            <td><?php echo PHP_OS; ?></td>
        </tr>
    </table>
</main>

<footer>
    <p>Carlos Vico &mdash; 12345678A &mdash; <?php echo date('Y'); ?></p>
</footer>

</body>
</html>
