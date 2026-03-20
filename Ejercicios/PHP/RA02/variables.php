<?php
/**
 * RA02_H - Ámbitos de variables en PHP: global y local
 *
 * Demuestra cómo PHP aísla el ámbito de las funciones y
 * cómo la keyword `global` permite acceder a variables externas.
 *
 * @author  Carlos Vico
 * @version 1.0
 */

/** @var string Variable accesible desde el ámbito global */
$mensaje = "Bienvenido al sitio";

/**
 * Muestra el mensaje global y un mensaje local de la función.
 *
 * Sin `global`, $mensaje sería undefined dentro de la función,
 * ya que PHP no hereda el ámbito global automáticamente.
 *
 * @return void
 */
function mostrar_mensaje(): void
{
    // `global` crea un alias local que apunta a la variable global
    global $mensaje;

    // Variable con ámbito estrictamente local: no existe fuera de esta función
    $mensajeLocal = "Mensaje generado dentro de la función.";

    echo "Global: " . htmlspecialchars($mensaje) . "<br>";
    echo "Local: "  . htmlspecialchars($mensajeLocal) . "<br>";
}

mostrar_mensaje();

// Verificamos que $mensajeLocal NO existe en el ámbito global
echo isset($mensajeLocal)
    ? "ERROR: mensajeLocal visible en global"
    : "Correcto: mensajeLocal no existe en el ámbito global.";
