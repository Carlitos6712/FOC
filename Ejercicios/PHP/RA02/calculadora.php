<?php
/**
 * RA02_D - Calculadora básica con formulario PHP
 *
 * @author  Carlos Vico
 * @version 1.0
 */

/**
 * Realiza la operación aritmética entre dos operandos.
 *
 * @param float  $a         Primer operando.
 * @param float  $b         Segundo operando.
 * @param string $operacion Operación: suma|resta|multiplica|divide.
 * @return float|string     Resultado numérico o mensaje de error.
 */
function calcular(float $a, float $b, string $operacion): float|string
{
    switch ($operacion) {
        case 'suma':
            return $a + $b;
        case 'resta':
            return $a - $b;
        case 'multiplica':
            return $a * $b;
        case 'divide':
            // La división por cero debe validarse antes de llegar aquí,
            // pero añadimos guarda como defensa en profundidad
            if ($b == 0) {
                return 'Error: división por cero.';
            }
            return $a / $b;
        default:
            return 'Operación no reconocida.';
    }
}

$resultado = null;
$error     = '';

$operacionesValidas = ['suma', 'resta', 'multiplica', 'divide'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $num1      = $_POST['num1']      ?? '';
    $num2      = $_POST['num2']      ?? '';
    $operacion = $_POST['operacion'] ?? '';

    if (!is_numeric($num1) || !is_numeric($num2)) {
        $error = 'Ambos valores deben ser números válidos.';
    } elseif (!in_array($operacion, $operacionesValidas, true)) {
        $error = 'Operación no válida.';
    } elseif ($operacion === 'divide' && (float)$num2 == 0) {
        $error = 'No se puede dividir por cero.';
    } else {
        $resultado = calcular((float)$num1, (float)$num2, $operacion);
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>RA02_D - Calculadora</title>
    <style>
        body   { font-family: Arial, sans-serif; max-width: 400px; margin: 2rem auto; }
        label  { display: block; margin-top: .8rem; }
        input, select, button { width: 100%; padding: .5rem; margin-top: .3rem; box-sizing: border-box; }
        button { background: #333; color: #fff; border: none; cursor: pointer; margin-top: 1rem; }
        .resultado { font-size: 1.3rem; color: #27a; margin-top: 1rem; }
        .error     { color: red; margin-top: 1rem; }
    </style>
</head>
<body>

<h1>Calculadora</h1>

<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
    <label>Número 1
        <input type="number" step="any" name="num1"
               value="<?php echo htmlspecialchars($_POST['num1'] ?? ''); ?>" required>
    </label>

    <label>Número 2
        <input type="number" step="any" name="num2"
               value="<?php echo htmlspecialchars($_POST['num2'] ?? ''); ?>" required>
    </label>

    <label>Operación
        <select name="operacion">
            <?php foreach (['suma' => 'Sumar', 'resta' => 'Restar', 'multiplica' => 'Multiplicar', 'divide' => 'Dividir'] as $val => $label) : ?>
                <option value="<?php echo $val; ?>"
                    <?php echo (($_POST['operacion'] ?? '') === $val) ? 'selected' : ''; ?>>
                    <?php echo $label; ?>
                </option>
            <?php endforeach; ?>
        </select>
    </label>

    <button type="submit">Calcular</button>
</form>

<?php if ($error !== '') : ?>
    <p class="error"><?php echo htmlspecialchars($error); ?></p>
<?php endif; ?>

<?php if ($resultado !== null) : ?>
    <p class="resultado">Resultado: <strong><?php echo $resultado; ?></strong></p>
<?php endif; ?>

</body>
</html>
