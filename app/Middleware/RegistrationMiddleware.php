<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RegistrationMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Check if registration is disabled
        if ($request->routeIs('register') && setting('registration_enabled') === 'false') {
            return redirect('/')->with('error', 'Registration is currently disabled.');
        }
        
        return $next($request);
    }
}