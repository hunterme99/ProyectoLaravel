@extends('admin.layout')

@section('content')
    <h1>Editar usuario</h1>

    <form action="{{ route('admin.usuarios.update', $usuario->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Nombre:</label>
        <input type="text" name="nombre" value="{{ $usuario->nombre }}" required>

        <br><br>

        <label>Email:</label>
        <input type="email" name="email" value="{{ $usuario->email }}" required>

        <br><br>

        <button type="submit">Guardar cambios</button>
    </form>

@endsection