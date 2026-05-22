@extends('layouts.app')
@vite(['resources/css/admin.css', 'resources/js/admin.js'])

@section('content')

    {{-- TARJETA PRINCIPAL DEL POST --}}
    <div class="foro-post-card">

        <div class="foro-header">
            <div class="foro-avatar">
                {{ strtoupper(substr($publicacion->usuario->nombre, 0, 1)) }}
            </div>

            <div class="foro-header-info">
                <strong>{{ $publicacion->usuario->nombre }}</strong>
                <small>{{ $publicacion->fecha }}</small>
            </div>
        </div>

        <h1 class="foro-titulo">{{ $publicacion->titulo }}</h1>

        <p class="foro-contenido-detalle">{{ $publicacion->contenido }}</p>
    </div>

    {{-- RESPUESTAS --}}
    <h3 class="foro-respuestas-titulo">Respuestas</h3>

    <div class="foro-respuestas">
        @foreach($publicacion->respuestas as $resp)
            <div class="foro-respuesta-card">

                <div class="foro-header">
                    <div class="foro-avatar">
                        {{ strtoupper(substr($resp->usuario->nombre, 0, 1)) }}
                    </div>

                    <div class="foro-header-info">
                        <strong>{{ $resp->usuario->nombre }}</strong>
                        <small>{{ $resp->fecha }}</small>
                    </div>
                </div>

                <p class="foro-respuesta-texto">{{ $resp->comentario }}</p>
            </div>
        @endforeach
    </div>

    {{-- FORMULARIO --}}
    <h3 class="foro-responder-titulo">Responder</h3>

    <form action="{{ route('foro.responder', $publicacion->id) }}" method="POST" class="foro-responder">
        @csrf

        <label for="comentario">Escribe tu respuesta:</label>
        <textarea id="comentario" name="comentario" required></textarea>

        <button type="submit" class="boton">Enviar</button>
    </form>

@endsection