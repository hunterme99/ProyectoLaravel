<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Receta extends Model
{
    protected $table = 'receta';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'titulo',
        'descripcion',
        'fecha_creacion',
        'imagen',
        'dificultad',
        'id_usuario',
        'id_categoria'
    ];

    // RELACIONES

    // Una receta pertenece a un usuario
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }

    // Una receta pertenece a una categoría
    public function ingredientes()
    {
        return $this->hasMany(Ingrediente::class, 'id_receta');
    }

    public function pasos()
    {
        return $this->hasMany(Paso::class, 'id_receta');
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria');
    }


    // Una receta tiene muchos comentarios
    public function comentarios()
    {
        return $this->hasMany(Comentario::class, 'id_receta');
    }
}
