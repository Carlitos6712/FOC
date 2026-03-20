<?php
/**
 * RA05 - Controlador frontal (Front Controller)
 *
 * Punto de entrada único de la aplicación MVC.
 * Parsea la URL y delega en el controlador correspondiente.
 *
 * @author  Carlos Vico
 * @version 1.0
 */

// Seguridad: constante que acredita el paso por el controlador frontal
define('CON_CONTROLADOR', true);

require_once __DIR__ . '/modelo.php';
require_once __DIR__ . '/controladores.php';

// Extraemos la ruta de la URL (e.g. /index.php/articulo → articulo)
$rutaCompleta = $_SERVER['REQUEST_URI'] ?? '/';
$partes       = explode('/', trim(parse_url($rutaCompleta, PHP_URL_PATH), '/'));

// El segmento relevante es el que sigue a index.php
// Ejemplo: /index.php/articulo?id=2  → $accion = 'articulo'
$accion = '';
foreach ($partes as $i => $parte) {
    if ($parte === 'index.php' || $parte === basename(__FILE__)) {
        $accion = $partes[$i + 1] ?? '';
        break;
    }
}

// Enrutamiento
switch ($accion) {
    case 'articulo':
        $id = isset($_GET['id']) ? (int)$_GET['id'] : null;
        mostrarDetalleArticulo($id);
        break;

    case 'sugerencias':
        gestionarSugerencias();
        break;

    case 'registro':
        gestionarRegistro();
        break;

    default:
        mostrarListadoArticulos();
        break;
}
