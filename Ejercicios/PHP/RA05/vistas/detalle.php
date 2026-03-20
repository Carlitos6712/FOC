<?php
/**
 * RA05 - vistas/detalle.php
 *
 * Vista del detalle de un artículo concreto.
 *
 * @author  Carlos Vico
 * @version 1.0
 */
if (!defined('CON_CONTROLADOR')) {
    die('Error: este archivo no puede ser llamado directamente.');
}

ob_start();
?>
<div class="card">
    <a href="index.php">&larr; Volver al catálogo</a>
    <h2><?php echo htmlspecialchars($articulo['nombre']); ?></h2>
    <p><strong>Categoría:</strong> <?php echo htmlspecialchars($articulo['categoria']); ?></p>
    <p><strong>Precio:</strong> <?php echo number_format($articulo['precio'], 2); ?> €</p>
    <p><strong>Descripción:</strong> <?php echo htmlspecialchars($articulo['descripcion']); ?></p>
</div>
<?php
$contenido = ob_get_clean();
$titulo    = htmlspecialchars($articulo['nombre']);
require __DIR__ . '/_layout.php';
