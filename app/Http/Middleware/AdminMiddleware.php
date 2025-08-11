<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 'Admin') {
            return $next($request);
        }

        // Option 1: Abort with 403 Forbidden
        // abort(403, 'Unauthorized action.');

        // Option 2: Redirect to another page (uncomment if preferred)
        return redirect()->back()->with('error', 'Authorization Required.');
    }
}
