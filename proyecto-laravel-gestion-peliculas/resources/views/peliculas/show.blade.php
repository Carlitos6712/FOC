{{-- @author Carlos Vico --}}
@extends('layouts.app')

@section('content')
    <h2>Detalle de Película</h2>

    <p><strong>ID:</strong> {{ $pelicula->id }}</p>
    <p><strong>Título:</strong> {{ $pelicula->titulo }}</p>
    <p><strong>Director:</strong> {{ $pelicula->director }}</p>
    <p><strong>Año:</strong> {{ $pelicula->año }}</p>

    <a href="{{ route('peliculas.edit', $pelicula->id) }}" class="btn btn-warning">Editar</a>
    <a href="{{ route('peliculas.index') }}" class="btn">Volver</a>
@endsection