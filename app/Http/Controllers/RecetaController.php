<?php

namespace App\Http\Controllers;

use App\Models\Receta;
use App\Models\Categoria;
use App\Models\Ingrediente;
use App\Models\Paso;
use Illuminate\Http\Request;

class RecetaController extends Controller
{
    // Mostrar todas las recetas
    public function index()
    {
        $recetas = Receta::with('categoria')->get();
        return view('recetas.index', compact('recetas'));
    }

    // Formulario de creación
    public function create()
    {
        $categorias = Categoria::all();
        return view('recetas.create', compact('categorias'));
    }

    // Guardar receta completa
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required',
            'descripcion' => 'required',
            'id_categoria' => 'required',
            'imagen' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'ingredientes.*' => 'required',
            'pasos.*' => 'required'
        ]);

        // Imagen
        $rutaImagen = null;
        if ($request->hasFile('imagen')) {
            $rutaImagen = $request->file('imagen')->store('recetas', 'public');
        }

        // Crear receta
        $receta = Receta::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $rutaImagen,
            'id_categoria' => $request->id_categoria,
            'id_usuario' => auth()->id(),
            'fecha_creacion' => now()
        ]);

        // Ingredientes
        foreach ($request->ingredientes as $ing) {
            Ingrediente::create([
                'nombre' => $ing,
                'id_receta' => $receta->id
            ]);
        }

        // Pasos
        foreach ($request->pasos as $paso) {
            Paso::create([
                'descripcion' => $paso,
                'id_receta' => $receta->id
            ]);
        }

        return redirect()->route('recetas.index');
    }

    // Mostrar receta
    public function show($id)
    {
        $receta = Receta::with(['ingredientes', 'pasos', 'categoria'])->findOrFail($id);
        return view('recetas.show', compact('receta'));
    }

    // Formulario de edición
    public function edit($id)
    {
        $receta = Receta::with(['ingredientes', 'pasos'])->findOrFail($id);
        $categorias = Categoria::all();
        return view('recetas.edit', compact('receta', 'categorias'));
    }

    // Actualizar receta
    public function update(Request $request, $id)
    {
        $request->validate([
            'titulo' => 'required',
            'descripcion' => 'required',
            'id_categoria' => 'required',
            'imagen' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'ingredientes.*' => 'required',
            'pasos.*' => 'required'
        ]);

        $receta = Receta::findOrFail($id);

        // Imagen nueva
        if ($request->hasFile('imagen')) {
            $receta->imagen = $request->file('imagen')->store('recetas', 'public');
        }

        // Actualizar datos principales
        $receta->update([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'id_categoria' => $request->id_categoria
        ]);

        // Borrar ingredientes y pasos anteriores
        Ingrediente::where('id_receta', $receta->id)->delete();
        Paso::where('id_receta', $receta->id)->delete();

        // Nuevos ingredientes
        foreach ($request->ingredientes as $ing) {
            Ingrediente::create([
                'nombre' => $ing,
                'id_receta' => $receta->id
            ]);
        }

        // Nuevos pasos
        foreach ($request->pasos as $paso) {
            Paso::create([
                'descripcion' => $paso,
                'id_receta' => $receta->id
            ]);
        }

        return redirect()->route('recetas.index');
    }

    // Eliminar receta
    public function destroy($id)
    {
        Receta::findOrFail($id)->delete();
        return redirect()->route('recetas.index');
    }
}
