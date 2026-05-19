@extends('admin.layout')
@vite(['resources/css/admin.css', 'resources/js/admin.js'])
@section('contenido')
    <h1>Editar ingrediente</h1>

    <form action="{{ route('ingredientes.update', $ingrediente->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Receta:</label>
        <select name="id_receta" required>
            @foreach($recetas as $r)
                <option value="{{ $r->id }}" {{ $ingrediente->id_receta == $r->id ? 'selected' : '' }}>
                    {{ $r->titulo }}
                </option>
            @endforeach
        </select>

        <br><br>

        <label>Nombre:</label>
        <input type="text" name="nombre" value="{{ $ingrediente->nombre }}" required>

        <br><br>

        <label>Cantidad:</label>
        <input type="text" name="cantidad" value="{{ $ingrediente->cantidad }}" required>

        <br><br>

        <button type="submit">Actualizar</button>
    </form>
@endsection