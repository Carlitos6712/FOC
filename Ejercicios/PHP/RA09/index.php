<!DOCTYPE html>
<!--
 * RA09_h - Índice navegable de todos los ejercicios del curso
 *
 * @author  Carlos Vico
 * @version 1.0
-->
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Índice — Ejercicios PHP</title>
    <style>
        * { box-sizing: border-box; }
        body  { font-family: 'Segoe UI', Arial, sans-serif; margin: 0; background: #f0f2f5; color: #222; }
        header { background: #1a1a2e; color: #fff; padding: 1.5rem 2rem; }
        header h1 { margin: 0; font-size: 1.6rem; }
        header p  { margin: .4rem 0 0; color: #aad4f5; font-size: .95rem; }
        main  { max-width: 900px; margin: 2rem auto; padding: 0 1rem; }
        .grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); gap: 1rem; }
        .card { background: #fff; border-radius: 8px; padding: 1.2rem 1.5rem; box-shadow: 0 2px 8px rgba(0,0,0,.08); }
        .card h2 { margin: 0 0 .6rem; font-size: 1rem; color: #1a1a2e; border-bottom: 2px solid #1a1a2e; padding-bottom: .3rem; }
        .card ul  { margin: 0; padding-left: 1.2rem; }
        .card li  { margin: .35rem 0; }
        .card a   { color: #1a6eb5; text-decoration: none; font-size: .9rem; }
        .card a:hover { text-decoration: underline; }
        footer { text-align: center; color: #888; font-size: .85rem; padding: 1.5rem; }
    </style>
</head>
<body>

<header>
    <h1>📂 Ejercicios PHP — Índice general</h1>
    <p>Carlos Vico &mdash; Desarrollo Web en Entorno Servidor</p>
</header>

<main>
    <div class="grid">

        <div class="card">
            <h2>RA01 — Introducción</h2>
            <ul>
                <li><a href="../RA01/index.php">Info del servidor</a></li>
                <li><a href="../RA01/tareas.php">Lista de tareas (fichero)</a></li>
            </ul>
        </div>

        <div class="card">
            <h2>RA02 — PHP Embebido</h2>
            <ul>
                <li><a href="../RA02/index.php">Saludo personalizado</a></li>
                <li><a href="../RA02/productos.php">Productos desde .txt</a></li>
                <li><a href="../RA02/calculadora.php">Calculadora</a></li>
                <li><a href="../RA02/variables_tipos.php">Variables y tipos</a></li>
                <li><a href="../RA02/variables.php">Ámbitos de variables</a></li>
            </ul>
        </div>

        <div class="card">
            <h2>RA03 — Programación básica</h2>
            <ul>
                <li><a href="../RA03/index.php">Decisiones, arrays, bucles y formularios</a></li>
            </ul>
        </div>

        <div class="card">
            <h2>RA04 — Sesiones y Cookies</h2>
            <ul>
                <li><a href="../RA04/login.php">Login (roles)</a></li>
                <li><a href="../RA04/sesion.php">Sesión + Cookie horario</a></li>
                <li><a href="../RA04/preferencias.php">Contador visitas + Tema</a></li>
            </ul>
        </div>

        <div class="card">
            <h2>RA05 — MVC</h2>
            <ul>
                <li><a href="../RA05/index.php">Catálogo artículos (listado)</a></li>
                <li><a href="../RA05/index.php/sugerencias">Sugerencias</a></li>
                <li><a href="../RA05/index.php/registro">Registro usuario</a></li>
            </ul>
        </div>

        <div class="card">
            <h2>RA06 — Base de Datos</h2>
            <ul>
                <li><a href="../RA06/index.php">Autores y libros (CRUD)</a></li>
            </ul>
        </div>

        <div class="card">
            <h2>RA07 — API REST</h2>
            <ul>
                <li><a href="../RA07/cliente.php">Cliente API (autores)</a></li>
                <li><a href="../RA07/cliente.php?action=get_listado_libros">Cliente API (libros)</a></li>
                <li><a href="../RA07/api.php?action=get_listado_autores">API directa (JSON)</a></li>
            </ul>
        </div>

        <div class="card">
            <h2>RA08 — AJAX</h2>
            <ul>
                <li><a href="../RA08/index.html">Búsqueda dinámica de libros</a></li>
            </ul>
        </div>

        <div class="card">
            <h2>RA09 — Servicios externos</h2>
            <ul>
                <li><a href="openlibrary.php">Open Library API</a></li>
            </ul>
        </div>

    </div>
</main>

<footer>Carlos Vico &mdash; <?php echo date('Y'); ?></footer>

</body>
</html>
