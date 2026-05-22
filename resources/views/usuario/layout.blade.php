<!DOCTYPE html>
<html lang="es">
@vite(['resources/css/admin.css', 'resources/js/admin.js'])

<head>
    <meta charset="UTF-8">
    <title>Panel Usuario</title>
</head>

<body>

    <!-- CABECERA DEL PANEL USUARIO -->
    <header class="usuario-header">
        <h1 class="usuario-header-titulo">Panel de usuario</h1>

        <div class="usuario-header-info">
            <p>Bienvenido, {{ auth()->user()->nombre }}</p>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="usuario-btn-logout">Cerrar sesión</button>
            </form>
        </div>
    </header>

    <!-- MENÚ DE NAVEGACIÓN DEL USUARIO -->
    <nav class="usuario-nav">
        <ul>
            <li><a href="/usuario">Inicio</a></li>
            <li><a href="/recetas">Recetas</a></li>
            <li><a href="/publicaciones">Foro</a></li>
        </ul>
    </nav>

    <!-- ZONA DONDE SE INSERTA EL CONTENIDO DE CADA VISTA HIJA -->
    <main class="usuario-main">
        @yield('contenido')
    </main>

</body>

</html>