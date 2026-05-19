@extends('layouts.app')
@vite(['resources/css/admin.css', 'resources/js/admin.js'])
@section('content')
    <h1>Nueva Publicación</h1>

    <form action="{{ route('foro.store') }}" method="POST">
        @csrf

        <label>Título</label>
        <input type="text" name="titulo" required>

        <label>Contenido</label>
        <textarea name="contenido" required></textarea>

        <button type="submit">Publicar</button>
    </form>

@endsection