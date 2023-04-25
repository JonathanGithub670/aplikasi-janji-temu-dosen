<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        foreach($roles as $role) {
            error_log($role);
            if(auth()->check() && auth()->user()->role === $role)
                return $next($request);
        }
        // abort(403, 'Tidak Memiliki Akses');
        // return response()->view('errors.403');
        //return $next($request);
        return response()->view('errors.403');
    }
}
