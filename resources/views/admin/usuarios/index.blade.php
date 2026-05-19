@extends('admin.layout')

@section('contenido')
    <h1>Gestión de usuarios</h1>

    <table border="1" cellpadding="8">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Activo</th>
            <th>Acciones</th>
        </tr>

        @foreach($usuarios as $u)
            <tr>
                <td>{{ $u->id }}</td>
                <td>{{ $u->nombre }}</td>
                <td>{{ $u->email }}</td>
                <td>{{ $u->activo ? 'Sí' : 'No' }}</td>

                <td>
                    <a href="{{ route('admin.usuarios.edit', $u->id) }}">Editar</a>

                    <form action="{{ route('admin.usuarios.toggle', $u->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit">
                            {{ $u->activo ? 'Desactivar' : 'Activar' }}
                        </button>
                    </form>

                    <form action="{{ route('admin.usuarios.destroy', $u->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Eliminar</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection