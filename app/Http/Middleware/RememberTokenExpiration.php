<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RememberTokenExpiration
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated and session has an expiration date
        if (Auth::check() && session()->has('remember_expiration')) {
            $expiration = session('remember_expiration');

            // If the remember token has expired, log the user out and redirect to login
            if (Carbon::now()->greaterThan($expiration)) {
                Auth::logout();
                session()->forget('remember_expiration'); // Clear expired session
                return redirect('auth/login')->withErrors([
                    'session_expired' => 'Your session has expired. Please log in again.',
                ]);
            }
        }

        return $next($request);
    }
}
