@extends('layouts.app')
@vite(['resources/css/admin.css', 'resources/js/admin.js'])
@section('content')
    <h1>Listado de Recetas</h1>

    <a href="{{ route('recetas.create') }}">Crear nueva receta</a>

    @foreach($recetas as $receta)
        <div>
            <h2>{{ $receta->titulo }}</h2>
            <p>{{ $receta->categoria->nombre }}</p>
            <a href="{{ route('recetas.show', $receta->id) }}">Ver</a>
            <a href="{{ route('recetas.edit', $receta->id) }}">Editar</a>

            <form action="{{ route('recetas.destroy', $receta->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">Eliminar</button>
            </form>
        </div>
    @endforeach

@endsection
