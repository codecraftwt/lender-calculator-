<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $roles
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {

        if (auth()->user()->deleted_flag == 1) {
            Auth::logout();
            return redirect('/login')->with('error', 'Your account is deactivated. Please contact admin.');
        }
        if (Auth::check() && in_array(Auth::user()->role, $roles)) {
            return $next($request);
        }
        return redirect('/login')->with('error', 'Authorization Required.');
    }
}
