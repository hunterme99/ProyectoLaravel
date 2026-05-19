@extends('admin.layout')
@vite(['resources/css/admin.css', 'resources/js/admin.js'])
@section('contenido')
    <h1>Editar comentario</h1>

    <form action="{{ route('comentarios.update', $comentario->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Usuario:</label>
        <select name="id_usuario" required>
            @foreach($usuarios as $u)
                <option value="{{ $u->id }}" {{ $comentario->id_usuario == $u->id ? 'selected' : '' }}>
                    {{ $u->nombre }}
                </option>
            @endforeach
        </select>

        <br><br>

        <label>Receta:</label>
        <select name="id_receta" required>
            @foreach($recetas as $r)
                <option value="{{ $r->id }}" {{ $comentario->id_receta == $r->id ? 'selected' : '' }}>
                    {{ $r->titulo }}
                </option>
            @endforeach
        </select>

        <br><br>

        <label>Contenido:</label>
        <textarea name="contenido" required>{{ $comentario->contenido }}</textarea>

        <br><br>

        <button type="submit">Actualizar</button>
    </form>
@endsection