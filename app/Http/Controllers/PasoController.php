<?php

namespace App\Http\Controllers;

use App\Models\Paso;
use App\Models\Receta;
use Illuminate\Http\Request;

class PasoController extends Controller
{
    public function index()
    {
        $pasos = Paso::with('receta')->orderBy('id_receta')->orderBy('orden')->get();
        return view('pasos.index', compact('pasos'));
    }

    public function create()
    {
        $recetas = Receta::all();
        return view('pasos.create', compact('recetas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_receta' => 'required|exists:receta,id',
            'descripcion' => 'required',
            'orden' => 'required|integer|min=1'
        ]);

        Paso::create([
            'id_receta' => $request->id_receta,
            'descripcion' => $request->descripcion,
            'orden' => $request->orden
        ]);

        return redirect()->route('pasos.index');
    }

    public function edit($id)
    {
        $paso = Paso::findOrFail($id);
        $recetas = Receta::all();

        return view('pasos.edit', compact('paso', 'recetas'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_receta' => 'required|exists:receta,id',
            'descripcion' => 'required',
            'orden' => 'required|integer|min:1'
        ]);


        $paso = Paso::findOrFail($id);

        $paso->update([
            'id_receta' => $request->id_receta,
            'descripcion' => $request->descripcion,
            'orden' => $request->orden
        ]);

        return redirect()->route('pasos.index');
    }

    public function destroy($id)
    {
        Paso::destroy($id);
        return redirect()->route('pasos.index');
    }
}
