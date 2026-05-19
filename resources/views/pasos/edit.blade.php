@extends('admin.layout')
@vite(['resources/css/admin.css', 'resources/js/admin.js'])
@section('contenido')
    <h1>Editar paso</h1>

    <form action="{{ route('pasos.update', $paso->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Receta:</label>
        <select name="id_receta" required>
            @foreach($recetas as $r)
                <option value="{{ $r->id }}" {{ $paso->id_receta == $r->id ? 'selected' : '' }}>
                    {{ $r->titulo }}
                </option>
            @endforeach
        </select>

        <br><br>

        <label>Orden:</label>
        <input type="number" name="orden" value="{{ $paso->orden }}" min="1" required>

        <br><br>

        <label>Descripción:</label>
        <textarea name="descripcion" required>{{ $paso->descripcion }}</textarea>

        <br><br>

        <button type="submit">Actualizar</button>
    </form>
@endsection