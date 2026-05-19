@extends('admin.layout')
@vite(['resources/css/admin.css', 'resources/js/admin.js'])
@section('contenido')
    <h1>Crear ingrediente</h1>

    <form action="{{ route('ingredientes.store') }}" method="POST">
        @csrf

        <label>Receta:</label>
        <select name="id_receta" required>
            <option value="">Seleccione una receta</option>
            @foreach($recetas as $r)
                <option value="{{ $r->id }}">{{ $r->titulo }}</option>
            @endforeach
        </select>

        <br><br>

        <label>Nombre:</label>
        <input type="text" name="nombre" required>

        <br><br>

        <label>Cantidad:</label>
        <input type="text" name="cantidad" required>

        <br><br>

        <button type="submit">Guardar</button>
    </form>
@endsection