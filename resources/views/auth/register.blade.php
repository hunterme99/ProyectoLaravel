<!DOCTYPE html>
<html lang="es">
@vite(['resources/css/admin.css', 'resources/js/admin.js'])
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
    
</head>

<body class="bg-gray-100 flex items-center justify-center h-screen">

    <div class="bg-white p-8 rounded shadow w-96">
        <h1 class="text-2xl font-bold mb-6 text-center">Crear cuenta</h1>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <label class="block mb-2">Nombre</label>
            <input type="text" name="nombre" class="w-full border p-2 rounded mb-4" required>

            <label class="block mb-2">Email</label>
            <input type="email" name="email" class="w-full border p-2 rounded mb-4" required>

            <label class="block mb-2">Contraseña</label>
            <input type="password" name="password" class="w-full border p-2 rounded mb-4" required>

            <button class="w-full bg-green-600 text-white p-2 rounded hover:bg-green-700">
                Registrarse
            </button>
        </form>

        <p class="mt-4 text-center">
            ¿Ya tienes cuenta?
            <a href="{{ route('login.form') }}" class="text-blue-600">Inicia sesión</a>
        </p>
    </div>

</body>

</html>