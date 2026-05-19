@extends('layouts.app')
@vite(['resources/css/admin.css', 'resources/js/admin.js'])
@section('content')
    <h1>Foro</h1>

    <a href="{{ route('foro.create') }}">Crear publicación</a>

    @foreach($publicaciones as $pub)
        <div style="border:1px solid #ccc; padding:10px; margin:10px 0;">
            <h2>{{ $pub->titulo }}</h2>
            <p>{{ $pub->contenido }}</p>
            <small>Por: {{ $pub->usuario->nombre }}</small>
            <br>
            <a href="{{ route('foro.show', $pub->id) }}">Ver más</a>
        </div>
    @endforeach

@endsection
