<?php
/**
 * RA05 - vistas/sugerencias.php
 *
 * Vista del formulario y listado de sugerencias (en memoria / sesión).
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
    <h2>Sugerencias</h2>

    <form method="POST" action="index.php/sugerencias">
        <label>Nueva sugerencia
            <input type="text" name="sugerencia" placeholder="Escribe tu sugerencia..." required>
        </label>
        <br><br>
        <button class="btn" type="submit">Enviar</button>
    </form>

    <h3>Sugerencias recibidas</h3>
    <?php if (empty($sugerencias)) : ?>
        <p>No hay sugerencias todavía.</p>
    <?php else : ?>
        <ul>
            <?php foreach ($sugerencias as $s) : ?>
                <li><?php echo $s; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>
<?php
$contenido = ob_get_clean();
$titulo    = 'Sugerencias';
require __DIR__ . '/_layout.php';
