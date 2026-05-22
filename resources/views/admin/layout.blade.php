<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="rol-usuario" content="{{ auth()->user()->rol }}">
    <title>Panel Admin</title>

    @vite(['resources/css/admin.css', 'resources/js/admin.js'])
</head>

<body>

    {{-- ============================
    HEADER NUEVO
    ============================ --}}
    <header class="header">
        <div class="header-bar">
            <nav class="nav">
                <ul class="nav-list">

                    {{-- Panel administrador a la izquierda --}}
                    <li class="nav-item nav-admin">
                        <a href="{{ route('admin.usuarios.index') }}">Panel administrador</a>
                    </li>

                    {{-- Enlaces generales --}}
                    <li class="nav-item"><a href="{{ route('recetas.index') }}">Recetas</a></li>
                    <li class="nav-item"><a href="{{ route('foro.index') }}">Foro</a></li>

                    {{-- Cerrar sesión --}}
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn-logout">Cerrar sesión</button>
                        </form>
                    </li>

                </ul>
            </nav>
        </div>
    </header>


    {{-- ============================
    CONTENIDO DEL PANEL ADMIN
    ============================ --}}
    <div class="panel-admin-container">

        {{-- MENÚ LATERAL --}}
        <aside class="panel-admin-menu">
            <h3>Administración</h3>

            <ul>
                <li><a href="{{ route('admin.usuarios.index') }}">Usuarios</a></li>
                <li><a href="{{ route('categorias.index') }}">Categorías</a></li>
                <li><a href="{{ route('recetas.index') }}">Recetas</a></li>
                <li><a href="{{ route('ingredientes.index') }}">Ingredientes</a></li>
                <li><a href="{{ route('pasos.index') }}">Pasos</a></li>
                <li><a href="{{ route('comentarios.index') }}">Comentarios</a></li>
                <li><a href="{{ route('publicaciones.index') }}">Foro</a></li>
            </ul>
        </aside>

        {{-- CONTENIDO PRINCIPAL --}}
        <main class="panel-admin-content">

            {{-- ENVOLTORIO AUTOMÁTICO PARA TABLAS BONITAS --}}
            <div class="panel-table">
                @yield('contenido')
            </div>

        </main>

    </div>

</body>

</html>