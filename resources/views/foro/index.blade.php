@extends('layouts.app')
@vite(['resources/css/admin.css', 'resources/js/admin.js'])

@section('content')
    <h1>Foro</h1>

    <a href="{{ route('foro.create') }}" class="boton">Crear publicación</a>

    <div class="foro-grid">
        @foreach($publicaciones as $pub)
            <div class="foro-card">

                <div class="foro-header">
                    <div class="foro-avatar">
                        {{ strtoupper(substr($pub->usuario->nombre, 0, 1)) }}
                    </div>

                    <div>
                        <strong>{{ $pub->usuario->nombre }}</strong><br>
                        <small>{{ $pub->fecha }}</small>
                    </div>
                </div>

                <h2 class="foro-titulo">{{ $pub->titulo }}</h2>

                <p class="foro-contenido">
                    {{ Str::limit($pub->contenido, 120, '...') }}
                </p>

                <div class="foro-botones">
                    <a href="{{ route('foro.show', $pub->id) }}" class="boton">Ver más</a>
                </div>

            </div>
        @endforeach
    </div>
@endsection