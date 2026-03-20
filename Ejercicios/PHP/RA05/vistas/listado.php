<?php
/**
 * RA05 - vistas/listado.php
 *
 * Vista del listado de artículos del catálogo.
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
    <h2>Catálogo de artículos</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Categoría</th>
                <th>Precio</th>
                <th>Detalle</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($articulos as $a) : ?>
                <tr>
                    <td><?php echo $a['id']; ?></td>
                    <td><?php echo htmlspecialchars($a['nombre']); ?></td>
                    <td><?php echo htmlspecialchars($a['categoria']); ?></td>
                    <td><?php echo number_format($a['precio'], 2); ?> €</td>
                    <td>
                        <a class="btn" href="index.php/articulo?id=<?php echo $a['id']; ?>">Ver</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php
$contenido = ob_get_clean();
$titulo    = 'Catálogo';
require __DIR__ . '/_layout.php';
