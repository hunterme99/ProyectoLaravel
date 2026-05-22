<?php

namespace App\Http\Controllers;

use App\Models\Receta;
use App\Models\Categoria;
use App\Models\Ingrediente;
use App\Models\Paso;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class RecetaController extends Controller
{
    use AuthorizesRequests;

    // Mostrar todas las recetas
    public function index(Request $request)
    {
        $categorias = Categoria::all();

        $query = Receta::query()->with('categoria');

        if ($request->filled('categoria')) {
            $query->where('id_categoria', $request->categoria);
        }

        $recetas = $query->get();

        return view('recetas.index', compact('recetas', 'categorias'));
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
            'imagen' => 'nullable|image|mimes:jpg,png,jpeg,webp|max:4096',

            'ingredientes' => 'nullable|array',
            'ingredientes.*' => 'nullable|string',

            'pasos' => 'nullable|array',
            'pasos.*' => 'nullable|string',
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
        if ($request->ingredientes) {
            foreach ($request->ingredientes as $ing) {
                if ($ing !== null && $ing !== '') {
                    Ingrediente::create([
                        'nombre' => $ing,
                        'id_receta' => $receta->id
                    ]);
                }
            }
        }

        // Pasos
        if ($request->pasos) {
            foreach ($request->pasos as $paso) {
                if ($paso !== null && $paso !== '') {
                    Paso::create([
                        'descripcion' => $paso,
                        'id_receta' => $receta->id
                    ]);
                }
            }
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
            'imagen' => 'nullable|image|mimes:jpg,png,jpeg,webp|max:4096',

            'ingredientes' => 'nullable|array',
            'ingredientes.*' => 'nullable|string',

            'pasos' => 'nullable|array',
            'pasos.*' => 'nullable|string',
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
        if ($request->ingredientes) {
            foreach ($request->ingredientes as $ing) {
                if ($ing !== null && $ing !== '') {
                    Ingrediente::create([
                        'nombre' => $ing,
                        'id_receta' => $receta->id
                    ]);
                }
            }
        }

        // Nuevos pasos
        if ($request->pasos) {
            foreach ($request->pasos as $paso) {
                if ($paso !== null && $paso !== '') {
                    Paso::create([
                        'descripcion' => $paso,
                        'id_receta' => $receta->id
                    ]);
                }
            }
        }

        return redirect()->route('recetas.index');
    }

    // Eliminar receta
    public function destroy(Receta $receta)
    {
        $this->authorize('delete', $receta);
        $receta->delete();

        return redirect()->route('recetas.index')->with('success', 'Receta eliminada correctamente.');
    }

    // ============================
    // ENVIAR PDF POR CORREO
    // ============================

    private function convertir($texto)
    {
        // Convertir UTF-8 → ISO-8859-1 (lo que usa FPDF)
        return iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $texto);
    }

    public function enviarPDF($id)
    {
        // Incluir librerías
        require_once base_path('fpdf/fpdf.php');
        require_once base_path('PHPMailer/src/PHPMailer.php');
        require_once base_path('PHPMailer/src/SMTP.php');
        require_once base_path('PHPMailer/src/Exception.php');

        // Obtener receta
        $receta = Receta::with(['ingredientes', 'pasos'])->findOrFail($id);

        // Generar PDF
        $pdf = new \FPDF();
        $pdf->AddPage();

        // ============================
        // IMAGEN DE LA RECETA
        // ============================
        if ($receta->imagen) {
            $rutaImagen = public_path('storage/' . $receta->imagen);

            if (file_exists($rutaImagen)) {

                list($ancho, $alto) = getimagesize($rutaImagen);

                $maxAncho = 180;
                $escala = $maxAncho / $ancho;
                $nuevoAncho = $maxAncho;
                $nuevoAlto = $alto * $escala;

                $x = (210 - $nuevoAncho) / 2;

                $pdf->Image($rutaImagen, $x, 10, $nuevoAncho, $nuevoAlto);
                $pdf->Ln($nuevoAlto + 15);
            }
        }

        // ============================
        // TÍTULO
        // ============================
        $pdf->SetFont('Arial', 'B', 18);
        $pdf->Cell(0, 10, $this->convertir($receta->titulo), 0, 1, 'C');

        $pdf->Ln(5);

        // ============================
        // DESCRIPCIÓN
        // ============================
        $pdf->SetFont('Arial', '', 12);
        $descripcion = $this->convertir("Descripción:\n" . $receta->descripcion);
        $pdf->MultiCell(0, 8, $descripcion);

        $pdf->Ln(5);

        // ============================
        // INGREDIENTES
        // ============================
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(0, 10, $this->convertir("Ingredientes:"), 0, 1);

        $pdf->SetFont('Arial', '', 12);
        foreach ($receta->ingredientes as $ing) {
            $pdf->Cell(0, 8, $this->convertir("• " . $ing->nombre), 0, 1);
        }

        $pdf->Ln(5);

        // ============================
        // PASOS
        // ============================
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(0, 10, $this->convertir("Pasos:"), 0, 1);

        $pdf->SetFont('Arial', '', 12);
        foreach ($receta->pasos as $i => $paso) {
            $pdf->MultiCell(0, 8, $this->convertir(($i + 1) . ". " . $paso->descripcion));
            $pdf->Ln(2);
        }

        // Guardar PDF
        $rutaPDF = storage_path("app/receta_{$receta->id}.pdf");
        $pdf->Output('F', $rutaPDF);

        // ============================
        // ENVIAR CORREO
        // ============================
        $mail = new \PHPMailer\PHPMailer\PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'rotcivsf@gmail.com';
            $mail->Password = 'vjar rleg velc ykfy';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('rotcivsf@gmail.com', 'Recetario');
            $mail->addAddress(auth()->user()->email);

            $mail->Subject = $this->convertir("Tu receta: {$receta->titulo}");
            $mail->Body = $this->convertir("Aquí tienes el PDF de la receta.");
            $mail->addAttachment($rutaPDF);

            $mail->send();

        } catch (\Exception $e) {
            return back()->with('error', 'Error al enviar el PDF: ' . $e->getMessage());
        }

        return back()->with('success', 'PDF enviado correctamente.');
    }

}
