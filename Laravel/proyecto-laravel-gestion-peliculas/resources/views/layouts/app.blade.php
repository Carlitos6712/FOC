{{-- @author Carlos Vico --}}
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Películas</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 900px; margin: 40px auto; padding: 0 20px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 10px; border: 1px solid #ddd; text-align: left; }
        th { background: #f4f4f4; }
        .btn { padding: 6px 14px; text-decoration: none; border-radius: 4px; border: none; cursor: pointer; }
        .btn-primary { background: #3490dc; color: white; }
        .btn-warning { background: #f6993f; color: white; }
        .btn-danger  { background: #e3342f; color: white; }
        .alert { padding: 12px; margin-bottom: 16px; border-radius: 4px; background: #d4edda; color: #155724; }
        .form-group { margin-bottom: 14px; }
        label { display: block; margin-bottom: 4px; font-weight: bold; }
        input { width: 100%; padding: 8px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px; }
        .error { color: #e3342f; font-size: 0.875em; }
    </style>
</head>
<body>
    <h1>🎬 Gestión de Películas</h1>
    <hr>

    {{-- Mensaje flash de éxito --}}
    @if (session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif

    @yield('content')
</body>
</html>