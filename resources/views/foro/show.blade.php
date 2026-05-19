@extends('layouts.app')
@vite(['resources/css/admin.css', 'resources/js/admin.js'])
@section('content')
    <h1>{{ $publicacion->titulo }}</h1>

    <p>{{ $publicacion->contenido }}</p>
    <small>Por: {{ $publicacion->usuario->nombre }}</small>

    <hr>

    <h3>Respuestas</h3>

    @foreach($publicacion->respuestas as $resp)
        <div style="border:1px solid #ddd; padding:10px; margin:10px 0;">
            <p>{{ $resp->comentario }}</p>
            <small>Por: {{ $resp->usuario->nombre }}</small>
        </div>
    @endforeach

    <hr>

    <h3>Responder</h3>

    <form action="{{ route('foro.responder', $publicacion->id) }}" method="POST">
        @csrf

        <label for="comentario">Escribe tu respuesta:</label>
        <textarea id="comentario" name="comentario" required style="width:100%; height:120px; resize:vertical;"></textarea>

        <br><br>
        <button type="submit">Enviar</button>
    </form>

@endsection