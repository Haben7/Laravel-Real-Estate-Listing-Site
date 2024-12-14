<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

// class AdminMiddleware
// {
  
//     public function handle(Request $request, Closure $next)
//     {
//         if (!Auth::check() || Auth::user()->role !== 'admin') {
//             return redirect('/'); // Redirect if not admin
//         }
//         return $next($request);
//     }


class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->role === 'admin') {
            return $next($request);
        }
        return redirect('/'); // Redirect to the home page or login page if not an admin
    }
}


