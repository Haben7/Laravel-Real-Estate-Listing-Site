<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


// class OwnerMiddleware
// {
//     // public function handle(Request $request, Closure $next)
//     // {
//     //     if (auth()->user()->role !== 'owner') {
//     //         return redirect('/home');
//     //     }
//     //     elseif(Auth::check() && Auth::user()->role === 'owner') {
//     //         return $next($request);
//     //     }
//     //     return redirect('/');    }
//     public function handle(Request $request, Closure $next)
//     {
//         if (!Auth::check() || Auth::user()->role !== 'owner') {
//             return redirect('/'); // Redirect if not owner
//         }
//         return $next($request);
//     }
// }


class OwnerMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->role === 'owner') {
            return $next($request);
        }
        return redirect('/'); // Redirect if not an owner
    }
}
