<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    /*
        CRUD: Create, Read, Update y Delete.
        Este controlador incluye las funciones para crear, mostrar, editar y eliminar usuarios.
    */

    // Método para mostrar todos los usuarios
    public function index()
    {
        // Obtengo todos los usuarios de la base de datos
        $usuarios = Usuario::all();

        // Devuelvo la vista con la lista de usuarios
        return view('usuarios.index', compact('usuarios'));
    }

    // Método para mostrar el formulario de creación de un usuario
    public function create()
    {
        // Devuelvo la vista del formulario de creación
        return view('usuarios.create');
    }

    // Método para guardar un usuario nuevo en la base de datos
    public function store(Request $request)
    {
        // Valido los datos enviados desde el formulario
        $request->validate([
            'nombre' => 'required',
            'email' => 'required|email|unique:usuario,email',
            'password' => 'required',
            'rol' => 'required'
        ]);

        // Creo un nuevo usuario con los datos validados
        Usuario::create([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'rol' => $request->rol,
            'fecha_registro' => now()
        ]);

        // Redirijo a la lista de usuarios
        return redirect()->route('usuarios.index');
    }

    // Método para mostrar un usuario concreto
    public function show($id)
    {
        // Busco el usuario por su id
        $usuario = Usuario::findOrFail($id);

        // Devuelvo la vista con los datos del usuario
        return view('usuarios.show', compact('usuario'));
    }

    // Método para mostrar el formulario de edición de un usuario
    public function edit($id)
    {
        // Busco el usuario que se va a editar
        $usuario = Usuario::findOrFail($id);

        // Devuelvo la vista del formulario de edición
        return view('usuarios.edit', compact('usuario'));
    }

    // Método para actualizar un usuario en la base de datos
    public function update(Request $request, $id)
    {
        // Valido los datos enviados desde el formulario
        $request->validate([
            'nombre' => 'required',
            'email' => 'required|email',
            'rol' => 'required'
        ]);

        // Busco el usuario que se va a actualizar
        $usuario = Usuario::findOrFail($id);

        // Actualizo los datos del usuario
        $usuario->update([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'rol' => $request->rol
        ]);

        // Si el usuario quiere cambiar la contraseña
        if ($request->password) {
            $usuario->update([
                'password' => bcrypt($request->password)
            ]);
        }

        // Redirijo a la lista de usuarios
        return redirect()->route('usuarios.index');
    }

    // Método para eliminar un usuario
    public function destroy($id)
    {
        // Busco el usuario que se va a eliminar
        $usuario = Usuario::findOrFail($id);

        // Elimino el usuario
        $usuario->delete();

        // Redirijo a la lista de usuarios
        return redirect()->route('usuarios.index');
    }
}
