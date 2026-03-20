<?php
/**
 * RA05 - vistas/_layout.php
 *
 * Plantilla base compartida por todas las vistas (Template Inheritance manual).
 * Se incluye al inicio de cada vista definiendo $titulo y $contenido.
 *
 * @author  Carlos Vico
 * @version 1.0
 */
if (!defined('CON_CONTROLADOR')) {
    die('Error: este archivo no puede ser llamado directamente.');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($titulo ?? 'Tienda Online'); ?></title>
    <style>
        * { box-sizing: border-box; }
        body { font-family: 'Segoe UI', Arial, sans-serif; margin: 0; background: #f0f2f5; color: #222; }
        header { background: #1a1a2e; color: #fff; padding: 1rem 2rem; display: flex; align-items: center; gap: 2rem; }
        header h1 { margin: 0; font-size: 1.4rem; }
        nav a  { color: #aad4f5; margin-right: 1.2rem; text-decoration: none; font-size: .95rem; }
        nav a:hover { text-decoration: underline; }
        main { max-width: 900px; margin: 2rem auto; padding: 0 1rem; }
        .card { background: #fff; border-radius: 8px; padding: 1.5rem; margin-bottom: 1rem; box-shadow: 0 2px 6px rgba(0,0,0,.08); }
        .btn  { display: inline-block; padding: .5rem 1.2rem; background: #1a1a2e; color: #fff; border: none; border-radius: 4px; cursor: pointer; text-decoration: none; font-size: .9rem; }
        .btn:hover { background: #2e2e5e; }
        footer { text-align: center; padding: 1rem; color: #888; font-size: .85rem; }
        table { width: 100%; border-collapse: collapse; }
        th    { background: #1a1a2e; color: #fff; padding: .6rem 1rem; text-align: left; }
        td    { border-bottom: 1px solid #eee; padding: .6rem 1rem; }
        input[type="text"], input[type="email"], input[type="password"], textarea {
            width: 100%; padding: .5rem; border: 1px solid #ccc; border-radius: 4px; margin-top: .3rem;
        }
        label { display: block; margin-top: .8rem; font-weight: bold; }
        .msg-ok  { color: #27a; font-weight: bold; }
        .msg-err { color: red; font-weight: bold; }
    </style>
</head>
<body>

<header>
    <h1>🛒 Tienda Online</h1>
    <nav>
        <a href="index.php">Artículos</a>
        <a href="index.php/sugerencias">Sugerencias</a>
        <a href="index.php/registro">Registro</a>
    </nav>
</header>

<main>
    <?php echo $contenido ?? ''; ?>
</main>

<footer>Carlos Vico &mdash; RA05 MVC &mdash; <?php echo date('Y'); ?></footer>

</body>
</html>
