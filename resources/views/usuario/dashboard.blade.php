{{-- Esta vista usa el layout base del panel usuario --}}
@extends('usuario.layout')
@vite(['resources/css/admin.css', 'resources/js/admin.js'])
{{-- Rellena la sección "contenido" definida en usuario/layout.blade.php --}}
@section('contenido')

    <h2>Inicio del panel usuario</h2>
    <p>Selecciona una opción del menú.</p>

@endsection