<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class ValidateTypeUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $requiredPrivilegeRole): Response
    {

        if (Auth::check()) { // Obtiene los roles del usuario desde la sesión
            $userRoles = Auth::user()->roles;
            // Verifica si alguno de los roles del usuario coincide con el rol requerido
            foreach ($userRoles as $role) {
                if ($role->name === $requiredPrivilegeRole) {
                    // Si coincide, permite que la solicitud continúe
                    return $next($request);
                }
            }
        }

        // Si el usuario no tiene el rol requerido, aborta la solicitud con un error 403
        abort(403, 'Acceso prohibido');
    }
}
