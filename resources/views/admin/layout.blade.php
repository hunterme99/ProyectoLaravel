<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="rol-usuario" content="{{ auth()->user()->rol }}">

    <title>Panel Admin</title>

    @vite(['resources/css/admin.css', 'resources/js/admin.js'])
</head>

<body>

    <header>
        <h1>Panel de administrador</h1>

        <p>Bienvenido, {{ auth()->user()->nombre }}</p>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Cerrar sesión</button>
        </form>
    </header>

    <nav>
        <ul>
            <li><a href="{{ route('admin.usuarios.index') }}" data-admin="true">Usuarios</a></li>
            <li><a href="/categorias" data-admin="true">Categorías</a></li>
            <li><a href="/recetas" data-admin="true">Recetas</a></li>
            <li><a href="/ingredientes" data-admin="true">Ingredientes</a></li>
            <li><a href="/pasos" data-admin="true">Pasos</a></li>
            <li><a href="/comentarios" data-admin="true">Comentarios</a></li>
            <li><a href="/publicaciones" data-admin="true">Foro</a></li>

        </ul>
    </nav>

    <main>
        @yield('contenido')
    </main>

</body>

</html>