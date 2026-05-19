@extends('layouts.app')
@vite(['resources/css/admin.css', 'resources/js/admin.js'])
@section('content')
    <h1>{{ $receta->titulo }}</h1>

    @if($receta->imagen)
        <img src="{{ asset('storage/' . $receta->imagen) }}" width="300">
    @endif

    <p>{{ $receta->descripcion }}</p>

    <h3>Ingredientes</h3>
    <ul>
        @foreach($receta->ingredientes as $ing)
            <li>{{ $ing->nombre }}</li>
        @endforeach
    </ul>

    <h3>Pasos</h3>
    <ol>
        @foreach($receta->pasos as $paso)
            <li>{{ $paso->descripcion }}</li>
        @endforeach
    </ol>

@endsection