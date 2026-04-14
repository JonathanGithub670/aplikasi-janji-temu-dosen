<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Role
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        foreach ($roles as $role) {
            if (auth()->check() && auth()->user()->role === $role) {
                return $next($request);
            }
        }

        return response()->view('errors.403', [], 403);
    }
}
