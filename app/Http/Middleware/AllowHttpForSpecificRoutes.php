<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AllowHttpForSpecificRoutes
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $allowedRoutes = [
            'data.php',
        ];

        if (!$request->secure() && !in_array($request->path(), $allowedRoutes)) {
            return redirect()->secure($request->getRequestUri());
        }

        return $next($request);
    }
}
