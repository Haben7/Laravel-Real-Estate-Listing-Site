<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    // public function handle($request, Closure $next)
    // {
    //     // Check if the authenticated user is an admin
    //     if (Auth::check() || Auth::user()->role !== 'admin') {
    //         return $next($request);
    //     }

    //     // If the user is not an admin, redirect to the home page or return 403
    //     return redirect('/')->with('error', 'Unauthorized access');
    // }
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect('/'); // Redirect if not admin
        }
        return $next($request);
    }
}
