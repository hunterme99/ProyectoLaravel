<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RespuestaForo extends Model
{
    protected $table = 'respuesta_foro';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'id_publicacion',
        'id_usuario',
        'comentario',   
        'fecha'
    ];

    public function publicacion()
    {
        return $this->belongsTo(PublicacionForo::class, 'id_publicacion');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }
}
