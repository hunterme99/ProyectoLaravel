@extends('admin.layout')
@vite(['resources/css/admin.css', 'resources/js/admin.js'])
@section('contenido')
    <h1>Gestión de pasos</h1>

    <a href="{{ route('pasos.create') }}">Crear paso</a>

    <table border="1" cellpadding="8">
        <tr>
            <th>ID</th>
            <th>Receta</th>
            <th>Orden</th>
            <th>Descripción</th>
            <th>Acciones</th>
        </tr>

        @foreach($pasos as $p)
            <tr>
                <td>{{ $p->id }}</td>
                <td>{{ $p->receta->titulo ?? 'Sin receta' }}</td>
                <td>{{ $p->orden }}</td>
                <td>{{ $p->descripcion }}</td>
                <td>
                    <a href="{{ route('pasos.edit', $p->id) }}">Editar</a>

                    <form action="{{ route('pasos.destroy', $p->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Eliminar</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection