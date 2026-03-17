{{-- @author Carlos Vico --}}
@extends('layouts.app')

@section('content')
    <h2>Editar Título</h2>

    <form action="{{ route('peliculas.update', $pelicula->id) }}" method="POST">
        @csrf
        @method('PUT')  {{-- Spoofing: HTML no soporta PUT nativamente --}}

        <div class="form-group">
            <label for="titulo">Título</label>
            <input type="text" id="titulo" name="titulo" value="{{ old('titulo', $pelicula->titulo) }}">
            @error('titulo') <span class="error">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('peliculas.index') }}" class="btn">Cancelar</a>
    </form>
@endsection
```

---

## 7️⃣ Estructura final de archivos
```
app/
├── Http/Controllers/PeliculaController.php
└── Models/Pelicula.php

database/migrations/
└── xxxx_create_peliculas_table.php

resources/views/
├── layouts/app.blade.php
└── peliculas/
    ├── index.blade.php
    ├── create.blade.php
    ├── show.blade.php
    └── edit.blade.php

routes/
└── web.php