{{-- @author Carlos Vico --}}
@extends('layouts.app')

@section('content')
    <h2>Nueva Película</h2>

    <form action="{{ route('peliculas.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="titulo">Título</label>
            <input type="text" id="titulo" name="titulo" value="{{ old('titulo') }}">
            @error('titulo') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="director">Director</label>
            <input type="text" id="director" name="director" value="{{ old('director') }}">
            @error('director') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="año">Año</label>
            <input type="number" id="año" name="año" value="{{ old('año') }}">
            @error('año') <span class="error">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('peliculas.index') }}" class="btn">Cancelar</a>
    </form>
@endsection