{{-- @author Carlos Vico --}}
@extends('layouts.app')

@section('content')
    <a href="{{ route('peliculas.create') }}" class="btn btn-primary">+ Nueva Película</a>
    <br><br>

    @if ($peliculas->isEmpty())
        <p>No hay películas registradas.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Director</th>
                    <th>Año</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($peliculas as $pelicula)
                    <tr>
                        <td>{{ $pelicula->id }}</td>
                        <td>{{ $pelicula->titulo }}</td>
                        <td>{{ $pelicula->director }}</td>
                        <td>{{ $pelicula->año }}</td>
                        <td>
                            <a href="{{ route('peliculas.show', $pelicula->id) }}" class="btn btn-primary">Ver</a>
                            <a href="{{ route('peliculas.edit', $pelicula->id) }}" class="btn btn-warning">Editar</a>

                            {{-- DELETE requiere método spoofing porque HTML solo soporta GET/POST --}}
                            <form action="{{ route('peliculas.destroy', $pelicula->id) }}"
                                  method="POST" style="display:inline"
                                  onsubmit="return confirm('¿Eliminar película?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection