<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    protected $table = 'comentario';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'contenido',
        'id_usuario',
        'id_receta',
        'fecha'
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }

    public function receta()
    {
        return $this->belongsTo(Receta::class, 'id_receta');
    }
}
