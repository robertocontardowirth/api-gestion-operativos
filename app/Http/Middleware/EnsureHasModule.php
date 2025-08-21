<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureHasModule
{
    public function handle(Request $request, Closure $next, string $moduleSlug): Response
    {
        $user = $request->user();
        if (!$user || !$user->hasModule($moduleSlug)) {
            abort(403, 'No autorizado. Requiere módulo: '.$moduleSlug);
        }
        return $next($request);
    }
}
