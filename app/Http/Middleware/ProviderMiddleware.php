<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProviderMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Verifica se l'utente ha il ruolo di 'Client'
        if ($request->user() && $request->user()->isProvider()) {
            return $next($request);
        }

        // Se non è admin, redirige alla homepage o a un'altra pagina
        return redirect('/');
    }
}
