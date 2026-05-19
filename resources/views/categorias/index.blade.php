@extends('admin.layout')
@vite(['resources/css/admin.css', 'resources/js/admin.js'])
@section('contenido')
<h1>Gestión de categorías</h1>

<a href="{{ route('categorias.create') }}">Crear categoría</a>

<table border="1" cellpadding="8">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Acciones</th>
    </tr>

    @foreach($categorias as $c)
    <tr>
        <td>{{ $c->id }}</td>
        <td>{{ $c->nombre }}</td>
        <td>
            <a href="{{ route('categorias.edit', $c->id) }}">Editar</a>

            <form action="{{ route('categorias.destroy', $c->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit">Eliminar</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection
