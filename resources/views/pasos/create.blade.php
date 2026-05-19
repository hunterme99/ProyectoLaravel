@extends('admin.layout')
@vite(['resources/css/admin.css', 'resources/js/admin.js'])
@section('contenido')
    <h1>Crear paso</h1>

    <form action="{{ route('pasos.store') }}" method="POST">
        @csrf

        <label>Receta:</label>
        <select name="id_receta" required>
            <option value="">Seleccione una receta</option>
            @foreach($recetas as $r)
                <option value="{{ $r->id }}">{{ $r->titulo }}</option>
            @endforeach
        </select>

        <br><br>

        <label>Orden:</label>
        <input type="number" name="orden" min="1" required>

        <br><br>

        <label>Descripción:</label>
        <textarea name="descripcion" required></textarea>

        <br><br>

        <button type="submit">Guardar</button>
    </form>
@endsection