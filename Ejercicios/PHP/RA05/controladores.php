<?php
/**
 * RA05 - controladores.php
 *
 * Contiene las funciones controladoras que conectan modelo y vistas.
 *
 * @author  Carlos Vico
 * @version 1.0
 */

if (!defined('CON_CONTROLADOR')) {
    die('Error: este archivo no puede ser llamado directamente.');
}

/**
 * Muestra el listado completo de artículos.
 *
 * @return void
 */
function mostrarListadoArticulos(): void
{
    $articulos = obtenerArticulos();
    require __DIR__ . '/vistas/listado.php';
}

/**
 * Muestra el detalle de un artículo concreto.
 *
 * @param int|null $id ID del artículo. null redirige al listado.
 * @return void
 */
function mostrarDetalleArticulo(?int $id): void
{
    if ($id === null) {
        header('Location: index.php');
        exit;
    }

    $articulo = obtenerArticuloPorId($id);

    if ($articulo === null) {
        http_response_code(404);
        echo '<p>Artículo no encontrado.</p>';
        return;
    }

    require __DIR__ . '/vistas/detalle.php';
}

/**
 * Gestiona el formulario y listado de sugerencias en memoria.
 *
 * Las sugerencias se almacenan en la sesión (solo durante la navegación).
 *
 * @return void
 */
function gestionarSugerencias(): void
{
    session_start();

    if (!isset($_SESSION['sugerencias'])) {
        $_SESSION['sugerencias'] = [];
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $texto = trim($_POST['sugerencia'] ?? '');
        if ($texto !== '') {
            $_SESSION['sugerencias'][] = htmlspecialchars($texto);
        }
    }

    $sugerencias = $_SESSION['sugerencias'];
    require __DIR__ . '/vistas/sugerencias.php';
}

/**
 * Gestiona el formulario de registro de usuario en memoria.
 *
 * @return void
 */
function gestionarRegistro(): void
{
    $mensajeRegistro = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $usuario = trim($_POST['usuario'] ?? '');
        $email   = trim($_POST['email']   ?? '');
        $pass    = trim($_POST['password'] ?? '');

        if ($usuario === '' || $email === '' || $pass === '') {
            $mensajeRegistro = 'Todos los campos son obligatorios.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $mensajeRegistro = 'El email no tiene un formato válido.';
        } else {
            $mensajeRegistro = "Usuario '$usuario' registrado correctamente (en memoria).";
        }
    }

    require __DIR__ . '/vistas/registro.php';
}
