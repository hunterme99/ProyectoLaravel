<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Proyecto Recetas</title>

    {{-- Rol para admin.js --}}
    @if(auth()->check())
        <meta name="rol-usuario" content="{{ auth()->user()->rol }}">
    @else
        <meta name="rol-usuario" content="invitado">
    @endif

    @vite(['resources/css/admin.css', 'resources/js/admin.js'])
</head>

<body>

@if(session('success'))
    <div id="flash-message" style="
            background: #d4edda;
            color: #155724;
            padding: 12px 18px;
            border-radius: 6px;
            border: 1px solid #c3e6cb;
            margin-bottom: 15px;
            font-size: 15px;
            transition: opacity 0.8s ease;
        ">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div id="flash-message" style="
            background: #f8d7da;
            color: #721c24;
            padding: 12px 18px;
            border-radius: 6px;
            border: 1px solid #f5c6cb;
            margin-bottom: 15px;
            font-size: 15px;
            transition: opacity 0.8s ease;
        ">
        {{ session('error') }}
    </div>
@endif



    <header class="header">
        <nav class="nav">
            <ul class="nav-list">

                {{-- PANEL ADMINISTRADOR (solo admin) --}}
                @if(auth()->check() && auth()->user()->rol === 'admin')
                    <li class="nav-item nav-admin">
                        <a href="{{ route('categorias.index') }}">Panel administrador</a>
                    </li>
                @endif

                <li class="nav-item"><a href="{{ route('recetas.index') }}">Recetas</a></li>
                <li class="nav-item"><a href="{{ route('foro.index') }}">Foro</a></li>

                @auth
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="btn-logout" type="submit">Cerrar sesión</button>
                        </form>
                    </li>
                @endauth

            </ul>
        </nav>
    </header>

    <main class="contenido">
        @yield('content')
    </main>



</body>

</html>