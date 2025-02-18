<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ClientMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Verifica se l'utente ha il ruolo di 'Client'
        if ($request->user() && $request->user()->isClient()) {
            return $next($request);
        }

        // Se non è admin, redirige alla homepage o a un'altra pagina
        return redirect('/');
    }
}

