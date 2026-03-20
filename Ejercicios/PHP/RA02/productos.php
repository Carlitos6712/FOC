<?php
/**
 * RA02_B - Lectura de productos desde archivo de texto y renderizado en tabla HTML
 *
 * @author  Carlos Vico
 * @version 1.0
 */

/** @var string Ruta al fichero de productos */
const PRODUCTOS_FILE = __DIR__ . '/productos.txt';

/**
 * Lee y parsea los productos del fichero CSV sencillo.
 *
 * Cada línea tiene el formato: NombreProducto,Precio
 *
 * @return array<array{nombre: string, precio: string}> Lista de productos.
 */
function leerProductos(): array
{
    if (!file_exists(PRODUCTOS_FILE)) {
        return [];
    }

    $lineas    = file(PRODUCTOS_FILE, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $productos = [];

    foreach ($lineas as $linea) {
        // explode limita a 2 partes para tolerar comas en el nombre
        $partes = explode(',', $linea, 2);

        if (count($partes) === 2) {
            $productos[] = [
                'nombre' => trim($partes[0]),
                'precio' => trim($partes[1]),
            ];
        }
    }

    return $productos;
}

$productos = leerProductos();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>RA02_B - Productos</title>
    <style>
        body  { font-family: Arial, sans-serif; max-width: 560px; margin: 2rem auto; }
        table { border-collapse: collapse; width: 100%; }
        th    { background: #333; color: #fff; padding: .6rem 1rem; }
        td    { border: 1px solid #ccc; padding: .5rem 1rem; }
        tr:nth-child(even) td { background: #f9f9f9; }
    </style>
</head>
<body>

<h1>Catálogo de productos</h1>

<?php if (empty($productos)) : ?>
    <p>No se encontraron productos o el archivo no existe.</p>
<?php else : ?>
    <table>
        <thead>
            <tr><th>Producto</th><th>Precio (€)</th></tr>
        </thead>
        <tbody>
            <?php foreach ($productos as $p) : ?>
                <tr>
                    <td><?php echo htmlspecialchars($p['nombre']); ?></td>
                    <td><?php echo htmlspecialchars($p['precio']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

</body>
</html>
