<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="rol-usuario" content="{{ auth()->user()->rol }}">
    <title>Recetas Web</title>

    @vite(['resources/css/admin.css', 'resources/js/admin.js'])
</head>

<body>

    <header>
        <h1>Recetas Web</h1>

        <p>Bienvenido, {{ auth()->user()->nombre }}</p>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Cerrar sesión</button>
        </form>
    </header>

    <nav>
        <ul>
            <li><a href="/recetas">Recetas</a></li>
            <li><a href="/categorias">Categorías</a></li>
            <li><a href="/publicaciones">Foro</a></li>
        </ul>
    </nav>

    <main>
        @yield('contenido')
    </main>

</body>
</html>
