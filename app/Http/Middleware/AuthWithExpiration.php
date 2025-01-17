<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthWithExpiration
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is not authenticated and is trying to access the dashboard
        if (Auth::check() && $request->is('auth/login')) {
            // Redirect logged-in users away from the login page to the dashboard
            return redirect()->route('auth.parking_right');
        }

        // Check if the user is authenticated but is trying to access the dashboard
        if (!Auth::check() && $request->is('auth/dashboard')) {
            // Redirect unauthenticated users to the login page
            return redirect()->route('auth.login');
        }

        return $next($request);
    }
}
