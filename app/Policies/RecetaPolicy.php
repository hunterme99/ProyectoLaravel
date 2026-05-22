<?php

namespace App\Policies;

use App\Models\Receta;
use App\Models\Usuario;

class RecetaPolicy
{
    /**
     * Determina si el usuario puede borrar la receta.
     */
    public function delete(Usuario $user, Receta $receta)
    {
        // El administrador puede borrar todas
        if ($user->rol === 'admin') {
            return true;
        }

        // El usuario solo puede borrar las suyas
        return $receta->id_usuario === $user->id;
    }
}
