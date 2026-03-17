{{-- @author Carlos Vico --}}
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Frutas</title>
</head>
<body>
    <ul>
        {{-- Iteramos el array recibido desde la ruta --}}
        @foreach ($frutas as $fruta)
            <li>{{ $fruta }}</li>
        @endforeach
    </ul>
</body>
</html>