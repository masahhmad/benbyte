<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            if (Auth::user()->role == 'user') {
                return $next($request);
            } else {
                return redirect('/' . Auth::user()->role)->with('message', 'Lu gada izin!');
            }
        } else {
            return redirect('/login')->with('message', 'Eits, login dulu!');
        }

        return $next($request);
    }
}
