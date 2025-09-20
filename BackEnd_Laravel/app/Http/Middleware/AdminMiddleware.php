<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated 
        if (!auth()->check()) {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }
        // Check if the user has the 'admin' role
        if (auth()->user()->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized - Admin access required'], 403);
        }
        // Proceed with the request if the user is authenticated and has the 'admin' role
        return $next($request);
    }
}
