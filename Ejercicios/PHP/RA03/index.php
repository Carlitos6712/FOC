<?php
/**
 * RA03 - Programación básica: decisiones, arrays, bucles, funciones y formularios
 *
 * Agrupa todos los ejercicios prácticos del RA03 en un único archivo
 * organizado por secciones claramente identificadas.
 *
 * @author  Carlos Vico
 * @version 1.0
 */

// ============================================================
// RA03_a - Mayor / menor de edad
// ============================================================

/**
 * Determina si una edad corresponde a mayor de edad.
 *
 * @param int $edad Edad del usuario.
 * @return string Mensaje descriptivo.
 */
function comprobarEdad(int $edad): string
{
    // 18 es el umbral legal estándar en España
    return $edad >= 18
        ? "Eres mayor de edad."
        : "Eres menor de edad.";
}

// ============================================================
// RA03_c - Generación de array decreciente de 3 en 3
// ============================================================

/**
 * Genera un array con valores decrecientes de 3 en 3 desde $valor hasta 0.
 *
 * @param int $valor Valor inicial (debe ser entero positivo).
 * @return int[]     Array con los valores generados.
 */
function generarArray(int $valor): array
{
    $numeros = [];

    // Se recorre hacia abajo de 3 en 3; range() no soporta pasos negativos con 0 como límite directo
    for ($i = $valor; $i >= 0; $i -= 3) {
        $numeros[] = $i;
    }

    return $numeros;
}

// ============================================================
// RA03_b - Tabla HTML a partir de un array
// ============================================================

/**
 * Genera el HTML de una tabla con una fila de celdas por cada valor del array.
 *
 * @param int[] $valores Array de valores a mostrar.
 * @return string        Código HTML de la tabla.
 */
function tabla(array $valores): string
{
    $html = '<table border="1" cellpadding="6" cellspacing="0"><tr>';

    foreach ($valores as $v) {
        $html .= '<td>' . htmlspecialchars((string)$v) . '</td>';
    }

    $html .= '</tr></table>';

    return $html;
}

// ============================================================
// RA03_g - Números del 1 al 10 con par/impar
// ============================================================

/**
 * Genera HTML con los números del 1 al 10 indicando si son pares o impares.
 *
 * @return string HTML con la lista de números.
 */
function listarParesImpares(): string
{
    $html = '<ul>';

    // El operador módulo (%) devuelve el resto de la división;
    // si es 0, el número es divisible entre 2, por lo tanto par.
    for ($i = 1; $i <= 10; $i++) {
        $tipo  = ($i % 2 === 0) ? 'par' : 'impar';
        $html .= "<li>$i &rarr; $tipo</li>";
    }

    $html .= '</ul>';

    return $html;
}

// ============================================================
// RA03_e - Procesamiento del formulario principal
// ============================================================

$mensajeFormulario = 'No se ha introducido ningún valor';
$tablaHtml         = '';

if (isset($_POST['valor'])) {
    $valor = $_POST['valor'];

    if ($valor === '') {
        $mensajeFormulario = 'Introduzca un valor.';
    } elseif (!is_numeric($valor)) {
        $mensajeFormulario = 'Introduzca un valor numérico.';
    } else {
        $num = (int)$valor;

        if ($num < 0) {
            $mensajeFormulario = 'Introduzca un valor positivo.';
        } elseif ($num >= 0 && $num <= 10) {
            $numeros           = generarArray($num);
            $tablaHtml         = tabla($numeros);
            $mensajeFormulario = '';
        } elseif ($num > 10) {
            $mensajeFormulario = 'Número demasiado grande.';
        } else {
            $mensajeFormulario = 'Valor desconocido.';
        }
    }
}

// RA03_d - Formulario nombre + edad (POST)
$saludoEdad = '';
if (isset($_POST['nombre_edad'])) {
    $nombre = htmlspecialchars(trim($_POST['nombre'] ?? ''));
    $edad   = (int)($_POST['edad'] ?? 0);
    if ($nombre !== '' && $edad > 0) {
        $saludoEdad = "Hola $nombre, tienes $edad años. " . comprobarEdad($edad);
    }
}

// RA03_f - Saludo por GET
$saludoGet = '';
if (isset($_GET['nombre'])) {
    $nombreGet  = htmlspecialchars(trim($_GET['nombre']));
    $saludoGet  = $nombreGet !== '' ? "Bienvenido, $nombreGet" : '';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>RA03 - Programación Básica</title>
    <style>
        body    { font-family: Arial, sans-serif; max-width: 640px; margin: 2rem auto; background: #f4f4f4; }
        h1      { background: #333; color: #fff; padding: 1rem; }
        h2      { border-bottom: 2px solid #333; padding-bottom: .3rem; }
        section { background: #fff; padding: 1.5rem; margin-bottom: 1.5rem; border-radius: 6px; }
        input, select, button { padding: .4rem .8rem; margin: .3rem 0; }
        button  { background: #333; color: #fff; border: none; cursor: pointer; }
        .result { margin-top: .8rem; color: #27a; font-weight: bold; }
        table   { border-collapse: collapse; }
        td      { padding: .4rem .8rem; }
        a       { color: #27a; }
    </style>
</head>
<body>

<h1>Tarea 3 - Programación básica</h1>

<!-- RA03_d - Nombre y edad -->
<section>
    <h2>RA03_d - Nombre y edad (POST)</h2>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <input type="hidden" name="nombre_edad" value="1">
        <label>Nombre: <input type="text" name="nombre" required></label><br>
        <label>Edad:   <input type="number" name="edad" min="1" max="120" required></label><br>
        <button type="submit">Enviar</button>
    </form>
    <?php if ($saludoEdad !== '') : ?>
        <p class="result"><?php echo $saludoEdad; ?></p>
    <?php endif; ?>
</section>

<!-- RA03_e - Formulario con validaciones -->
<section>
    <h2>RA03_e - Formulario con validaciones</h2>
    <form method="POST" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
        <label for="valor">Valor (0–10):</label>
        <input type="text" id="valor" name="valor">
        <button type="submit">Procesar</button>
    </form>

    <?php if ($mensajeFormulario !== '') : ?>
        <h2><?php echo htmlspecialchars($mensajeFormulario); ?></h2>
    <?php endif; ?>

    <?php if ($tablaHtml !== '') : ?>
        <?php echo $tablaHtml; ?>
    <?php endif; ?>
</section>

<!-- RA03_f - GET nombre -->
<section>
    <h2>RA03_f - Saludo por URL (GET)</h2>
    <p>
        Ejemplo de enlace:
        <a href="?nombre=Carlos">?nombre=Carlos</a>
    </p>
    <?php if ($saludoGet !== '') : ?>
        <p class="result"><?php echo $saludoGet; ?></p>
    <?php endif; ?>
</section>

<!-- RA03_g - Pares e impares (bucle for comentado) -->
<section>
    <h2>RA03_g - Números del 1 al 10</h2>
    <?php echo listarParesImpares(); ?>
</section>

</body>
</html>
