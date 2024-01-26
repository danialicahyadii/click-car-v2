<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetTitle
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, $pageTitle = null)
    {
        view()->share('title', $pageTitle);

        return $next($request);
    }
}
