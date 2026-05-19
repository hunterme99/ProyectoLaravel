<!DOCTYPE html>
<html lang="es">
@vite(['resources/css/admin.css', 'resources/js/admin.js'])
<head>
    <meta charset="UTF-8">
    <title>Panel Usuario</title> <!-- Título de la pestaña del navegador -->
</head>

<body>

    <!-- CABECERA DEL PANEL USUARIO -->
    <header>
        <h1>Panel de usuario</h1> <!-- Título principal del panel -->

        <!-- Muestra el nombre del usuario autenticado -->
        <p>Bienvenido, {{ auth()->user()->nombre }}</p>

        <!-- Formulario para cerrar sesión -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf <!-- Token obligatorio -->
            <button type="submit">Cerrar sesión</button>
        </form>
    </header>

    <!-- MENÚ DE NAVEGACIÓN DEL USUARIO -->
    <nav>
        <ul>
            <!-- Enlace a la página de inicio del panel usuario -->
            <li><a href="/usuario">Inicio</a></li>

            <!-- Enlaces accesibles para usuarios normales -->
            <li><a href="/recetas">Recetas</a></li>
            <li><a href="/publicaciones">Foro</a></li>
        </ul>
    </nav>

    <!-- ZONA DONDE SE INSERTA EL CONTENIDO DE CADA VISTA HIJA -->
    <main>
        @yield('contenido')
        <!-- Aquí se mostrará el contenido de cada vista que extienda este layout -->
    </main>

</body>

</html>