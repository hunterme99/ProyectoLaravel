@extends('layouts.app')
@vite(['resources/css/admin.css', 'resources/js/admin.js'])
@section('content')
    <h1>Editar Receta</h1>

    <form action="{{ route('recetas.update', $receta->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label>Título</label>
        <input type="text" name="titulo" value="{{ $receta->titulo }}" required>

        <label>Descripción</label>
        <textarea name="descripcion" required>{{ $receta->descripcion }}</textarea>

        <label>Categoría</label>
        <select name="id_categoria" required>
            @foreach($categorias as $cat)
                <option value="{{ $cat->id }}" @if($cat->id == $receta->id_categoria) selected @endif>
                    {{ $cat->nombre }}
                </option>
            @endforeach
        </select>

        <label>Imagen nueva (opcional)</label>
        <input type="file" name="imagen">

        <h3>Ingredientes</h3>
        <div id="ingredientes">
            @foreach($receta->ingredientes as $ing)
                <input type="text" name="ingredientes[]" value="{{ $ing->nombre }}" required>
            @endforeach
        </div>
        <button type="button" onclick="addIngrediente()">Añadir ingrediente</button>

        <h3>Pasos</h3>
        <div id="pasos">
            @foreach($receta->pasos as $paso)
                <textarea name="pasos[]" required>{{ $paso->descripcion }}</textarea>
            @endforeach
        </div>
        <button type="button" onclick="addPaso()">Añadir paso</button>

        <button type="submit">Actualizar receta</button>
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
