<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class ProviderMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check() || !auth()->user()->isProvider()) {
            return redirect('/dashboard')->with('error', 'Access denied. Providers only!');
        }

        return $next($request);
    }
}