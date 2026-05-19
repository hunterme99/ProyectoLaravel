<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /*
        Sistema de autenticación:
        Este controlador gestiona el login, registro y cierre de sesión.
    */

    // Mostrar formulario de login
    public function loginForm()
    {
        return view('auth.login');
    }

    // Procesar login
    public function login(Request $request)
    {
        // Valido los datos del formulario
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Intento autenticar al usuario
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

            // Regenero la sesión por seguridad
            $request->session()->regenerate();

            // Si el usuario es admin lo mando al panel admin
            if (Auth::user()->rol === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            // Si es usuario normal lo mando a su panel
            return redirect()->route('usuario.dashboard');
        }

        // Si falla el login
        return back()->withErrors([
            'email' => 'Credenciales incorrectas.'
        ]);
    }

    // Mostrar formulario de registro
    public function registerForm()
    {
        return view('auth.register');
    }

    // Procesar registro
    public function register(Request $request)
    {
        // Valido los datos
        $request->validate([
            'nombre' => 'required',
            'email' => 'required|email|unique:usuario,email',
            'password' => 'required|min:4'
        ]);

        // Creo el usuario
        Usuario::create([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'rol' => 'usuario', // Por defecto NO es admin
            'fecha_registro' => now()
        ]);

        // Redirijo al login
        return redirect()->route('login.form');
    }

    // Cerrar sesión
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.form');
    }
}
