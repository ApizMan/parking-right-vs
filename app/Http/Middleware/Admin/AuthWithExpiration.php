<?php

namespace App\Http\Middleware\Admin;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

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
        if (Auth::check() && $request->is('admin/login')) {
            // Redirect logged-in users away from the login page to the dashboard
            return redirect()->route('admin.dashboard');
        }

        // Check if the user is authenticated but is trying to access the dashboard
        if (!Auth::check() && $request->is('admin/dashboard')) {
            // Redirect unauthenticated users to the login page
            return redirect()->route('admin.login');
        }
        return $next($request);
    }
}
