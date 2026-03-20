<?php
/**
 * RA09_f - Consumo de servicio web externo: Open Library Search API
 *
 * Realiza una búsqueda de libros usando la API pública de Open Library
 * y muestra los resultados con maquetación HTML.
 * Usa file_get_contents() con contexto HTTP configurable.
 *
 * @author  Carlos Vico
 * @version 1.0
 */

/** @var string URL base de la API pública de Open Library */
const OPENLIBRARY_API = 'https://openlibrary.org/search.json';

/**
 * Busca libros en Open Library por título.
 *
 * @param string $termino Término de búsqueda.
 * @param int    $limite  Máximo de resultados a devolver.
 * @return array[]|null   Array de libros o null si hay error de red/parseo.
 */
function buscarEnOpenLibrary(string $termino, int $limite = 10): ?array
{
    $url = OPENLIBRARY_API . '?' . http_build_query([
        'title' => $termino,
        'limit' => $limite,
        'fields' => 'title,author_name,first_publish_year,number_of_pages_median',
    ]);

    // Contexto con timeout para evitar bloqueos indefinidos
    $contexto = stream_context_create([
        'http' => [
            'timeout'        => 5,
            'ignore_errors'  => true,
            'header'         => "Accept: application/json\r\n",
        ],
    ]);

    $json = @file_get_contents($url, false, $contexto);

    if ($json === false) {
        return null;
    }

    $datos = json_decode($json, true);

    return $datos['docs'] ?? null;
}

$termino    = trim($_GET['q'] ?? '');
$resultados = null;
$buscado    = false;

if ($termino !== '') {
    $buscado    = true;
    $resultados = buscarEnOpenLibrary($termino);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>RA09_f - Open Library</title>
    <style>
        * { box-sizing: border-box; }
        body  { font-family: 'Segoe UI', Arial, sans-serif; max-width: 820px; margin: 2rem auto; background: #f0f2f5; }
        h1    { background: #1a1a2e; color: #fff; padding: 1rem; border-radius: 6px; }
        form  { display: flex; gap: .5rem; margin-bottom: 1.5rem; }
        input { flex: 1; padding: .6rem; border: 1px solid #ccc; border-radius: 4px; font-size: 1rem; }
        button { padding: .6rem 1.2rem; background: #1a1a2e; color: #fff; border: none; border-radius: 4px; cursor: pointer; }
        .card { background: #fff; border-radius: 8px; padding: 1rem 1.5rem; margin-bottom: .8rem; box-shadow: 0 2px 6px rgba(0,0,0,.08); }
        .card h3 { margin: 0 0 .4rem; color: #1a1a2e; }
        .meta { color: #666; font-size: .9rem; }
        .error { color: red; }
    </style>
</head>
<body>

<h1>🌐 Búsqueda en Open Library — RA09_f</h1>

<form method="GET" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
    <input type="text" name="q"
           value="<?php echo htmlspecialchars($termino); ?>"
           placeholder="Buscar libro por título..." required>
    <button type="submit">Buscar</button>
</form>

<?php if ($buscado) : ?>

    <?php if ($resultados === null) : ?>
        <p class="error">No se pudo contactar con la API de Open Library. Inténtalo más tarde.</p>

    <?php elseif (empty($resultados)) : ?>
        <p>No se encontraron resultados para "<strong><?php echo htmlspecialchars($termino); ?></strong>".</p>

    <?php else : ?>
        <p>Resultados para: <strong><?php echo htmlspecialchars($termino); ?></strong></p>

        <?php foreach ($resultados as $libro) : ?>
            <div class="card">
                <h3><?php echo htmlspecialchars($libro['title'] ?? 'Sin título'); ?></h3>
                <p class="meta">
                    <strong>Autor/es:</strong>
                    <?php
                    $autores = $libro['author_name'] ?? [];
                    echo htmlspecialchars(implode(', ', $autores) ?: 'Desconocido');
                    ?>
                    &nbsp;|&nbsp;
                    <strong>Año:</strong>
                    <?php echo htmlspecialchars((string)($libro['first_publish_year'] ?? 'N/D')); ?>
                    &nbsp;|&nbsp;
                    <strong>Páginas:</strong>
                    <?php echo htmlspecialchars((string)($libro['number_of_pages_median'] ?? 'N/D')); ?>
                </p>
            </div>
        <?php endforeach; ?>

    <?php endif; ?>

<?php endif; ?>

</body>
</html>
