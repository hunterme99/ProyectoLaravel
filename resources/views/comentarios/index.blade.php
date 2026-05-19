@extends('admin.layout')
@vite(['resources/css/admin.css', 'resources/js/admin.js'])
@section('contenido')
    <h1>Gestión de comentarios</h1>

    <a href="{{ route('comentarios.create') }}">Crear comentario</a>

    <table border="1" cellpadding="8">
        <tr>
            <th>ID</th>
            <th>Usuario</th>
            <th>Receta</th>
            <th>Contenido</th>
            <th>Fecha</th>
            <th>Acciones</th>
        </tr>

        @foreach($comentarios as $c)
            <tr>
                <td>{{ $c->id }}</td>
                <td>{{ $c->usuario->nombre ?? 'Desconocido' }}</td>
                <td>{{ $c->receta->titulo ?? 'Sin receta' }}</td>
                <td>{{ $c->contenido }}</td>
                <td>{{ $c->fecha }}</td>
                <td>
                    <a href="{{ route('comentarios.edit', $c->id) }}">Editar</a>

                    <form action="{{ route('comentarios.destroy', $c->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Eliminar</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection