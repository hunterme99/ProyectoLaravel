@extends('layouts.app')
@vite(['resources/css/admin.css', 'resources/js/admin.js'])
@section('content')
    <h1>Crear Receta</h1>

    <form action="{{ route('recetas.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label>Título</label>
        <input type="text" name="titulo" required>

        <label>Descripción</label>
        <textarea name="descripcion" required></textarea>

        <label>Categoría</label>
        <select name="id_categoria" required>
            @foreach($categorias as $cat)
                <option value="{{ $cat->id }}">{{ $cat->nombre }}</option>
            @endforeach
        </select>

        <label>Imagen</label>
        <input type="file" name="imagen">

        <h3>Ingredientes</h3>
        <div id="ingredientes">
            <input type="text" name="ingredientes[]" required>
        </div>
        <button type="button" onclick="addIngrediente()">Añadir ingrediente</button>

        <h3>Pasos</h3>
        <div id="pasos">
            <textarea name="pasos[]" required></textarea>
        </div>
        <button type="button" onclick="addPaso()">Añadir paso</button>

        <button type="submit">Guardar receta</button>
    </form>

    <script>
        function addIngrediente() {
            document.getElementById('ingredientes')
                .insertAdjacentHTML('beforeend', '<input type="text" name="ingredientes[]" required>');
        }

        function addPaso() {
            document.getElementById('pasos')
                .insertAdjacentHTML('beforeend', '<textarea name="pasos[]" required></textarea>');
        }
    </script>

@endsection