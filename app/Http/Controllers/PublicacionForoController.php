<?php

namespace App\Http\Controllers;

use App\Models\PublicacionForo;
use Illuminate\Http\Request;

class PublicacionForoController extends Controller
{
    public function index()
    {
        $publicaciones = PublicacionForo::with('usuario')->get();
        return view('foro.index', compact('publicaciones'));
    }

    public function create()
    {
        return view('foro.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required',
            'contenido' => 'required'
        ]);

        PublicacionForo::create([
            'titulo' => $request->titulo,
            'contenido' => $request->contenido,
            'id_usuario' => auth()->id(),
            'fecha' => now()
        ]);

        return redirect()->route('foro.index');
    }

    public function show($id)
    {
        $publicacion = PublicacionForo::with(['usuario', 'respuestas.usuario'])->findOrFail($id);
        return view('foro.show', compact('publicacion'));
    }
}
