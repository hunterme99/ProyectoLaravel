<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class AdminUsuarioController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::all();
        return view('admin.usuarios.index', compact('usuarios'));
    }

    public function edit($id)
    {
        $usuario = Usuario::findOrFail($id);
        return view('admin.usuarios.edit', compact('usuario'));
    }

    public function update(Request $request, $id)
    {
        $usuario = Usuario::findOrFail($id);

        $request->validate([
            'nombre' => 'required',
            'email' => 'required|email'
        ]);

        $usuario->nombre = $request->nombre;
        $usuario->email = $request->email;
        $usuario->save();

        return redirect()->route('admin.usuarios.index');
    }

    public function toggle($id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->activo = !$usuario->activo;
        $usuario->save();

        return back();
    }

    public function destroy($id)
    {
        Usuario::destroy($id);
        return back();
    }
}
