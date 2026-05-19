<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categoria';
    public $timestamps = false;

    protected $fillable = [
        'nombre'
    ];

    public function recetas()
    {
        return $this->hasMany(Receta::class, 'id_categoria');
    }
}
