@extends('admin.layout')
@vite(['resources/css/admin.css', 'resources/js/admin.js'])
@section('contenido')
    <h1>Crear comentario</h1>

    <form action="{{ route('comentarios.store') }}" method="POST">
        @csrf

        <label>Usuario:</label>
        <select name="id_usuario" required>
            <option value="">Seleccione un usuario</option>
            @foreach($usuarios as $u)
                <option value="{{ $u->id }}">{{ $u->nombre }}</option>
            @endforeach
        </select>

        <br><br>

        <label>Receta:</label>
        <select name="id_receta" required>
            <option value="">Seleccione una receta</option>
            @foreach($recetas as $r)
                <option value="{{ $r->id }}">{{ $r->titulo }}</option>
            @endforeach
        </select>

        <br><br>

        <label>Contenido:</label>
        <textarea name="contenido" required></textarea>

        <br><br>

        <button type="submit">Guardar</button>
    </form>
@endsection