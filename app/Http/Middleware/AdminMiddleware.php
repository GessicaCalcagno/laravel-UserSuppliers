<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Verifica se l'utente ha il ruolo di 'admin'
        if ($request->user() && $request->user()->isAdmin()) {
            return $next($request);
        }

        // Se non è admin, redirige alla homepage o a un'altra pagina
        return redirect('/');
    }
}

