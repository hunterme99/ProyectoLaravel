<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
    protected $table = 'usuario';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'email',
        'password',
        'foto',
        'fecha_registro',
        'rol'
    ];

    protected $hidden = [
        'password'
    ];

    protected $casts = [
        'password' => 'hashed',
    ];


    // RELACIONES

    public function recetas()
    {
        return $this->hasMany(Receta::class, 'id_usuario');
    }

    public function comentarios()
    {
        return $this->hasMany(Comentario::class, 'id_usuario');
    }

    public function publicaciones()
    {
        return $this->hasMany(PublicacionForo::class, 'id_usuario');
    }

    public function respuestas()
    {
        return $this->hasMany(RespuestaForo::class, 'id_usuario');
    }
}
