<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ingrediente extends Model
{
    // Nombre de la tabla en la base de datos
    protected $table = 'ingrediente';

    // Clave primaria de la tabla
    protected $primaryKey = 'id';

    // La tabla no tiene created_at ni updated_at
    public $timestamps = false;

    // Campos que se pueden rellenar de forma masiva
    protected $fillable = [
        'id_receta',
        'nombre',
        'cantidad'
    ];

    // Relación: un ingrediente pertenece a una receta
    // Esto permite acceder a la receta a la que pertenece este ingrediente
    public function receta()
    {
        return $this->belongsTo(Receta::class, 'id_receta');
    }
}
