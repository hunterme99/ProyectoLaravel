<?php

namespace App\Http\Controllers;

use App\Models\RespuestaForo;
use Illuminate\Http\Request;

class RespuestaForoController extends Controller
{
    public function store(Request $request, $id)
    {
        $request->validate([
            'comentario' => 'required'
        ]);

        RespuestaForo::create([
            'comentario' => $request->comentario,
            'id_usuario' => auth()->id(),
            'id_publicacion' => $id,
            'fecha' => now()
        ]);

        return back();
    }
}
