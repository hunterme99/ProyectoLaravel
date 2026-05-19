<!DOCTYPE html>
<html lang="es">
@vite(['resources/css/admin.css', 'resources/js/admin.js'])
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    
</head>

<body class="bg-gray-100 flex items-center justify-center h-screen">

    <div class="bg-white p-8 rounded shadow w-96">
        <h1 class="text-2xl font-bold mb-6 text-center">Iniciar sesión</h1>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <label class="block mb-2">Email</label>
            <input type="email" name="email" class="w-full border p-2 rounded mb-4" required>

            <label class="block mb-2">Contraseña</label>
            <input type="password" name="password" class="w-full border p-2 rounded mb-4" required>

            <button class="w-full bg-blue-600 text-white p-2 rounded hover:bg-blue-700">
                Entrar
            </button>
        </form>

        <p class="mt-4 text-center">
            ¿No tienes cuenta?
            <a href="{{ route('register.form') }}" class="text-blue-600">Regístrate</a>
        </p>
    </div>

</body>

</html>