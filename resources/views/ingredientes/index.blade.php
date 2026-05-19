@extends('admin.layout')
@vite(['resources/css/admin.css', 'resources/js/admin.js'])
@section('contenido')
    <h1>Gestión de ingredientes</h1>

    <a href="{{ route('ingredientes.create') }}">Crear ingrediente</a>

    <table border="1" cellpadding="8">
        <tr>
            <th>ID</th>
            <th>Receta</th>
            <th>Nombre</th>
            <th>Cantidad</th>
            <th>Acciones</th>
        </tr>

        @foreach($ingredientes as $i)
            <tr>
                <td>{{ $i->id }}</td>
                <td>{{ $i->receta->titulo ?? 'Sin receta' }}</td>
                <td>{{ $i->nombre }}</td>
                <td>{{ $i->cantidad }}</td>
                <td>
                    <a href="{{ route('ingredientes.edit', $i->id) }}">Editar</a>

                    <form action="{{ route('ingredientes.destroy', $i->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Eliminar</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
