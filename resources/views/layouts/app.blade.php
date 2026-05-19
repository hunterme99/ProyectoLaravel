<!DOCTYPE html>
<html>
    @vite(['resources/css/admin.css', 'resources/js/admin.js'])
<head>
    <meta charset="UTF-8">
    <title>Recetas Web</title>
</head>
<body>

    <nav>
        <a href="/recetas">Recetas</a>
        <a href="/categorias">Categorías</a>
        <a href="/foro">Foro</a>

        @auth
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit">Cerrar sesión</button>
            </form>
        @endauth
    </nav>

    <hr>

    <!-- AQUÍ VA EL CONTENIDO DE LAS VISTAS -->
    @yield('content')

</body>
</html>
