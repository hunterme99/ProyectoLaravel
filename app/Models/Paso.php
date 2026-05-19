<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paso extends Model
{
    protected $table = 'pasos';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'id_receta',
        'descripcion',
        'orden'
    ];

    public function receta()
    {
        return $this->belongsTo(Receta::class, 'id_receta');
    }
}
