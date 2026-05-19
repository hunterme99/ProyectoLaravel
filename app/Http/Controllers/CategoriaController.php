<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::all();
        return view('categorias.index', compact('categorias'));

    }

    public function create()
    {
        return view('categorias.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required'
        ]);

        Categoria::create([
            'nombre' => $request->nombre
        ]);

        return redirect()->route('categorias.index');
    }

    public function edit($id)
    {
        $categoria = Categoria::findOrFail($id);
        return view('categorias.edit', compact('categoria'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required'
        ]);

        $categoria = Categoria::findOrFail($id);
        $categoria->nombre = $request->nombre;
        $categoria->save();

        return redirect()->route('categorias.index');
    }

    public function destroy($id)
    {
        Categoria::destroy($id);
        return redirect()->route('categorias.index');
    }
}
