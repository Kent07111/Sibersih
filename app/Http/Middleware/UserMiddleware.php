<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // Hanya tolak jika role bukan admin maupun user
        if (!in_array(auth()->user()->role, ['admin', 'user'])) {
            abort(403);
        }

        return $next($request);
    }
}
