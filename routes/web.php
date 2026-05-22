<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RecetaController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\IngredienteController;
use App\Http\Controllers\PasoController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\PublicacionForoController;
use App\Http\Controllers\RespuestaForoController;
use App\Http\Controllers\AdminForoController;
use App\Http\Controllers\AdminUsuarioController;
use Illuminate\Support\Facades\Mail;
use App\Mail\PruebaMail;
use App\Http\Controllers\ImagenController;


/*
|--------------------------------------------------------------------------
| Rutas públicas (sin login)
|--------------------------------------------------------------------------
*/

// Página de inicio 
Route::get('/', function () {
    return view('welcome');
});

// Login
Route::get('/login', [AuthController::class, 'loginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');

// Registro
Route::get('/register', [AuthController::class, 'registerForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/', function () {
    if (auth()->check()) {
        return auth()->user()->rol === 'admin'
            ? redirect()->route('admin.dashboard')
            : redirect()->route('usuario.dashboard');
    }

    return view('welcome');
});

Route::get('/hash/{pass}', function ($pass) {
    return bcrypt($pass);
});



/*
|--------------------------------------------------------------------------
| Rutas protegidas por login
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    /*
    |--------------------------------------------------------------------------
    | Panel ADMIN
    |--------------------------------------------------------------------------
    */
    Route::middleware('admin')->group(function () {

        // Dashboard admin
        Route::get('/admin', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');

        // CRUD de usuarios
       //Route::resource('usuarios', UsuarioController::class);

        // CRUD de categorías
        Route::resource('categorias', CategoriaController::class);

        // CRUD de recetas
        Route::resource('recetas', RecetaController::class);

        // CRUD de ingredientes
        Route::resource('ingredientes', IngredienteController::class);

        // CRUD de pasos
        Route::resource('pasos', PasoController::class);

        // CRUD de comentarios
        Route::resource('comentarios', ComentarioController::class);

        // CRUD del foro
        Route::resource('publicaciones', PublicacionForoController::class);
        Route::resource('respuestas', RespuestaForoController::class);

        Route::get('/admin/foro', [AdminForoController::class, 'index'])
            ->name('admin.foro.index');

        Route::get('/admin/foro/{id}', [AdminForoController::class, 'show'])
            ->name('admin.foro.show');

        Route::delete('/admin/foro/publicacion/{id}', [AdminForoController::class, 'destroyPublicacion'])
            ->name('admin.foro.publicacion.destroy');

        Route::delete('/admin/foro/respuesta/{id}', [AdminForoController::class, 'destroyRespuesta'])
            ->name('admin.foro.respuesta.destroy');
        Route::get('/admin/usuarios', [AdminUsuarioController::class, 'index'])->name('admin.usuarios.index');
    Route::get('/admin/usuarios/{id}/edit', [AdminUsuarioController::class, 'edit'])->name('admin.usuarios.edit');
    Route::post('/admin/usuarios/{id}/toggle', [AdminUsuarioController::class, 'toggle'])->name('admin.usuarios.toggle');
    Route::put('/admin/usuarios/{id}', [AdminUsuarioController::class, 'update'])->name('admin.usuarios.update');
        Route::delete('/admin/usuarios/{id}', [AdminUsuarioController::class, 'destroy'])->name('admin.usuarios.destroy');
    });

    


    /*
    |--------------------------------------------------------------------------
    | Panel USUARIO NORMAL
    |--------------------------------------------------------------------------
    */
    Route::middleware('usuario')->group(function () {

        // Dashboard usuario
        Route::get('/usuario', function () {
            return view('usuario.dashboard');
        })->name('usuario.dashboard');

        // Acceso a recetas
        Route::resource('recetas', RecetaController::class)->only(['index', 'show']);

        // Acceso a foro
        Route::resource('publicaciones', PublicacionForoController::class)->only(['index', 'show']);
        Route::resource('respuestas', RespuestaForoController::class)->only(['store']);
    });


    Route::middleware(['auth'])->group(function () {
        Route::resource('recetas', RecetaController::class);
    });


   // Route::resource('categorias', CategoriaController::class);


    Route::get('/foro', [PublicacionForoController::class, 'index'])->name('foro.index');
    Route::get('/foro/create', [PublicacionForoController::class, 'create'])->name('foro.create');
    Route::post('/foro', [PublicacionForoController::class, 'store'])->name('foro.store');
    Route::get('/foro/{id}', [PublicacionForoController::class, 'show'])->name('foro.show');

    Route::post('/foro/{id}/respuesta', [RespuestaForoController::class, 'store'])->name('foro.responder');
    Route::resource('comentarios', ComentarioController::class);

    Route::get('/probar-correo', function () {
        Mail::to('rotcivsf@gmail.com')->send(new PruebaMail());

        return 'Correo enviado (si no hay errores).';
    });


Route::post('/subir-imagen', [ImagenController::class, 'subir']);

    Route::post('/recetas/{id}/enviar-pdf', [RecetaController::class, 'enviarPDF'])
        ->name('recetas.enviarPDF');



});
