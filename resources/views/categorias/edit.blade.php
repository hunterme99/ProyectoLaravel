@extends('admin.layout')
@vite(['resources/css/admin.css', 'resources/js/admin.js'])
@section('contenido')
    <h1>Editar categoría</h1>

    <form action="{{ route('categorias.update', $categoria->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Nombre:</label>
        <input type="text" name="nombre" value="{{ $categoria->nombre }}" required>

        <br><br>

        <button type="submit">Actualizar</button>
    </form>
@endsection