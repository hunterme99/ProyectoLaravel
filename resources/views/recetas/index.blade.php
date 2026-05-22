@extends('layouts.app')
@vite(['resources/css/admin.css', 'resources/js/admin.js'])

@section('content')
    <h1>Listado de Recetas</h1>

    <a href="{{ route('recetas.create') }}" class="boton">Crear nueva receta</a>

    <div class="recetas-grid">
        @foreach($recetas as $receta)
            <div class="receta-card">

                {{-- IMAGEN DE LA RECETA --}}
                @if($receta->imagen)
                    <img src="/storage/{{ $receta->imagen }}" class="receta-img">
                @endif

                <h2>{{ $receta->titulo }}</h2>

                {{-- Categoría solo visible para admin --}}
                @if(auth()->check() && auth()->user()->rol === 'admin')
                    <p><strong>Categoría:</strong> {{ $receta->categoria->nombre }}</p>
                @endif

                <div class="botones">

                    {{-- Ver --}}
                    <a href="{{ route('recetas.show', $receta->id) }}" class="boton">Ver</a>

                    {{-- Editar: admin o dueño --}}
                    @can('update', $receta)
                        <a href="{{ route('recetas.edit', $receta->id) }}" class="boton">Editar</a>
                    @endcan

                    {{-- Eliminar: admin o dueño --}}
                    @can('delete', $receta)
                        <form action="{{ route('recetas.destroy', $receta->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="boton">Eliminar</button>
                        </form>
                    @endcan

                </div>

            </div>
        @endforeach
    </div>
@endsection