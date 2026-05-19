<?php

namespace App\Http\Controllers;

use App\Models\Ingrediente;
use App\Models\Receta;
use Illuminate\Http\Request;

class IngredienteController extends Controller
{
    public function index()
    {
        // Cargamos ingredientes con su receta asociada
        $ingredientes = Ingrediente::with('receta')->get();

        return view('ingredientes.index', compact('ingredientes'));
    }

    public function create()
    {
        // Necesitamos las recetas para el select
        $recetas = Receta::all();

        return view('ingredientes.create', compact('recetas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_receta' => 'required|exists:receta,id',
            'nombre' => 'required',
            'cantidad' => 'required'
        ]);

        Ingrediente::create([
            'id_receta' => $request->id_receta,
            'nombre' => $request->nombre,
            'cantidad' => $request->cantidad
        ]);

        return redirect()->route('ingredientes.index');
    }

    public function edit($id)
    {
        $ingrediente = Ingrediente::findOrFail($id);
        $recetas = Receta::all();

        return view('ingredientes.edit', compact('ingrediente', 'recetas'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_receta' => 'required|exists:receta,id',
            'nombre' => 'required',
            'cantidad' => 'required'
        ]);

        $ingrediente = Ingrediente::findOrFail($id);

        $ingrediente->update([
            'id_receta' => $request->id_receta,
            'nombre' => $request->nombre,
            'cantidad' => $request->cantidad
        ]);

        return redirect()->route('ingredientes.index');
    }

    public function destroy($id)
    {
        Ingrediente::destroy($id);

        return redirect()->route('ingredientes.index');
    }
}
