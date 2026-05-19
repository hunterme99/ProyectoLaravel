@extends('admin.layout')
@vite(['resources/css/admin.css', 'resources/js/admin.js'])
@section('contenido')
    <h1>Crear categoría</h1>

    <form action="{{ route('categorias.store') }}" method="POST">
        @csrf

        <label>Nombre:</label>
        <input type="text" name="nombre" required>

        <br><br>

        <button type="submit">Guardar</button>
    </form>
@endsection