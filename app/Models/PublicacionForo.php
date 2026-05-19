<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PublicacionForo extends Model
{
    // Nombre de la tabla en la base de datos
    protected $table = 'publicacion_foro';

    // Clave primaria de la tabla
    protected $primaryKey = 'id';

    // La tabla no utiliza created_at ni updated_at
    public $timestamps = false;

    // Campos que se pueden rellenar de forma masiva
    protected $fillable = [
        'id_usuario',
        'titulo',
        'contenido',
        'fecha'
    ];

    // Relación: una publicación pertenece a un usuario
    // Esto permite acceder al usuario que creó la publicación
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }

    // Relación: una publicación tiene muchas respuestas
    // Esto permite obtener todas las respuestas asociadas a esta publicación
    public function respuestas()
    {
        return $this->hasMany(RespuestaForo::class, 'id_publicacion');
    }
}
