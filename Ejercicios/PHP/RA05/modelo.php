<?php
/**
 * RA05 - modelo.php
 *
 * Contiene los datos del catálogo de artículos.
 * La constante CON_CONTROLADOR impide la llamada directa al archivo.
 *
 * @author  Carlos Vico
 * @version 1.0
 */

// Seguridad: impedir acceso directo sin pasar por el controlador frontal
if (!defined('CON_CONTROLADOR')) {
    die('Error: este archivo no puede ser llamado directamente.');
}

/**
 * Catálogo de artículos de la tienda.
 *
 * @var array<int, array{id: int, nombre: string, precio: float, descripcion: string, categoria: string}>
 */
$articulos = [
    0 => [
        'id'          => 0,
        'nombre'      => 'Teclado Mecánico RGB',
        'precio'      => 89.99,
        'descripcion' => 'Teclado mecánico con switches Cherry MX Red y retroiluminación RGB.',
        'categoria'   => 'Periféricos',
    ],
    1 => [
        'id'          => 1,
        'nombre'      => 'Ratón Inalámbrico Pro',
        'precio'      => 49.95,
        'descripcion' => 'Ratón ergonómico con sensor óptico de 16.000 DPI y batería de 70 h.',
        'categoria'   => 'Periféricos',
    ],
    2 => [
        'id'          => 2,
        'nombre'      => 'Monitor 27" 4K',
        'precio'      => 349.00,
        'descripcion' => 'Panel IPS 27 pulgadas resolución 3840×2160, 144 Hz, HDR400.',
        'categoria'   => 'Monitores',
    ],
    3 => [
        'id'          => 3,
        'nombre'      => 'Auriculares Gaming 7.1',
        'precio'      => 65.50,
        'descripcion' => 'Sonido envolvente virtual 7.1, micrófono retráctil con cancelación de ruido.',
        'categoria'   => 'Audio',
    ],
    4 => [
        'id'          => 4,
        'nombre'      => 'SSD NVMe 1 TB',
        'precio'      => 79.99,
        'descripcion' => 'Unidad de estado sólido M.2 PCIe 4.0, lectura 7.000 MB/s.',
        'categoria'   => 'Almacenamiento',
    ],
];

/**
 * Devuelve todos los artículos del catálogo.
 *
 * @return array<int, array> Lista completa de artículos.
 */
function obtenerArticulos(): array
{
    global $articulos;
    return $articulos;
}

/**
 * Devuelve un artículo por su ID.
 *
 * @param int $id Identificador del artículo.
 * @return array|null Datos del artículo o null si no existe.
 */
function obtenerArticuloPorId(int $id): ?array
{
    global $articulos;
    return $articulos[$id] ?? null;
}
