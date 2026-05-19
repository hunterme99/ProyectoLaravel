<?php

namespace App\Http\Controllers;

use App\Models\PublicacionForo;
use App\Models\RespuestaForo;

class AdminForoController extends Controller
{
    public function index()
    {
        $publicaciones = PublicacionForo::with('usuario')->get();
        return view('admin.foro.index', compact('publicaciones'));
    }

    public function show($id)
    {
        $publicacion = PublicacionForo::with('respuestas.usuario')->findOrFail($id);
        return view('admin.foro.show', compact('publicacion'));
    }

    public function destroyPublicacion($id)
    {
        PublicacionForo::destroy($id);
        return back();
    }

    public function destroyRespuesta($id)
    {
        RespuestaForo::destroy($id);
        return back();
    }
}
