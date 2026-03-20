<?php
/**
 * RA05 - vistas/registro.php
 *
 * Vista del formulario de registro de usuario (en memoria).
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
    <h2>Registro de usuario</h2>

    <?php if (!empty($mensajeRegistro)) : ?>
        <p class="<?php echo str_contains($mensajeRegistro, 'correctamente') ? 'msg-ok' : 'msg-err'; ?>">
            <?php echo htmlspecialchars($mensajeRegistro); ?>
        </p>
    <?php endif; ?>

    <form method="POST" action="index.php/registro">
        <label>Usuario
            <input type="text" name="usuario" required>
        </label>
        <label>Email
            <input type="email" name="email" required>
        </label>
        <label>Contraseña
            <input type="password" name="password" required>
        </label>
        <br>
        <button class="btn" type="submit">Registrar</button>
    </form>
</div>
<?php
$contenido = ob_get_clean();
$titulo    = 'Registro';
require __DIR__ . '/_layout.php';
