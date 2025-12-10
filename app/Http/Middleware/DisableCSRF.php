<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DisableCSRF
{
    public function handle($request, Closure $next)
    {
        $request->attributes->set('csrf_disabled', true);

        return $next($request);
    }
}
