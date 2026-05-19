<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\Usuario;
use App\Models\Receta;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    public function index()
    {
        $comentarios = Comentario::with(['usuario', 'receta'])
            ->orderBy('fecha', 'desc')
            ->get();

        return view('comentarios.index', compact('comentarios'));
    }

    public function create()
    {
        $usuarios = Usuario::all();
        $recetas = Receta::all();

        return view('comentarios.create', compact('usuarios', 'recetas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'contenido' => 'required',
            'id_usuario' => 'required|exists:usuario,id',
            'id_receta' => 'required|exists:receta,id'
        ]);

        Comentario::create([
            'contenido' => $request->contenido,
            'id_usuario' => $request->id_usuario,
            'id_receta' => $request->id_receta,
            'fecha' => now()
        ]);

        return redirect()->route('comentarios.index');
    }

    public function edit($id)
    {
        $comentario = Comentario::findOrFail($id);
        $usuarios = Usuario::all();
        $recetas = Receta::all();

        return view('comentarios.edit', compact('comentario', 'usuarios', 'recetas'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'contenido' => 'required',
            'id_usuario' => 'required|exists:usuario,id',
            'id_receta' => 'required|exists:receta,id'
        ]);

        $comentario = Comentario::findOrFail($id);

        $comentario->update([
            'contenido' => $request->contenido,
            'id_usuario' => $request->id_usuario,
            'id_receta' => $request->id_receta
        ]);

        return redirect()->route('comentarios.index');
    }

    public function destroy($id)
    {
        Comentario::destroy($id);
        return redirect()->route('comentarios.index');
    }
}
