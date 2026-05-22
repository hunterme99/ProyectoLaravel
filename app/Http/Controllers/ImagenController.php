<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImagenController extends Controller
{
    public function subir(Request $request)
    {
        // 1. Validamos que venga una imagen
        $request->validate([
            'imagen' => 'required|image|max:2048',
        ]);

        // 2. Guardamos la imagen en storage/app/public/imagenes
        // Laravel crea el nombre automáticamente
        $path = $request->file('imagen')->store('imagenes', 'public');

        // 3. Obtenemos la URL pública
        $url = Storage::url($path);

        // 4. Devolvemos la info
        return response()->json([
            'mensaje' => 'Imagen subida correctamente',
            'path' => $path,
            'url' => $url,
        ]);
    }
}
