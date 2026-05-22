@extends('layouts.app')
@vite(['resources/css/admin.css', 'resources/js/admin.js'])

@section('content')

    <div class="receta-show-container">

        {{-- TÍTULO --}}
        <h1 class="receta-titulo">{{ $receta->titulo }}</h1>

        {{-- IMAGEN PRINCIPAL --}}
        @if($receta->imagen)
            <div class="receta-imagen-container">
                <img src="/storage/{{ $receta->imagen }}" class="receta-imagen-grande">
            </div>
        @endif

        {{-- DESCRIPCIÓN --}}
        <section class="receta-seccion">
            <h2 class="receta-subtitulo">Descripción</h2>
            <p class="receta-descripcion">{{ $receta->descripcion }}</p>
        </section>

        {{-- INGREDIENTES --}}
        <section class="receta-seccion">
            <h2 class="receta-subtitulo">Ingredientes</h2>
            <ul class="receta-lista">
                @foreach($receta->ingredientes as $ing)
                    <li>{{ $ing->nombre }}</li>
                @endforeach
            </ul>
        </section>

        {{-- PASOS --}}
        <section class="receta-seccion">
            <h2 class="receta-subtitulo">Pasos</h2>
            <ol class="receta-lista">
                @foreach($receta->pasos as $paso)
                    <li>{{ $paso->descripcion }}</li>
                @endforeach
            </ol>
        </section>

        <form action="{{ route('recetas.enviarPDF', $receta->id) }}" method="POST">
            @csrf
            <button type="submit" class="boton">Enviar PDF al correo</button>
        </form>


    </div>

@endsection
