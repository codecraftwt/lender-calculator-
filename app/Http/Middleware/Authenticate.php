<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request)
    {
        if (! $request->expectsJson()) {
            // Web/browser requests → redirect
            session()->flash('error', 'Authentication required');
            return url('/login');
        }

        // For API/AJAX requests → JSON response
        abort(response()->json([
            'status'  => 'error',
            'message' => 'Authentication required.'
        ], 401));
    }
}
