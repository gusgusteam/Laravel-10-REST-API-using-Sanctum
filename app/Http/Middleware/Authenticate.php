<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        // Siempre retorna null para evitar redirección.
        return null;
    }

    /**
     * Si el usuario no está autenticado, devuelve una respuesta JSON.
     */
    protected function unauthenticated($request, array $guards)
    {
        // Devuelve una respuesta JSON personalizada en caso de no autenticación
        return response()->json([
            'success' => false,
            'message' => 'No está autenticado. Por favor, inicie sesión.',
            'error' => 'Unauthenticated',
        ], 401); // Código 401 para "No autorizado"
    }
    
}
