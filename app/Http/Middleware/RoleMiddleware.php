<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    // Check if the logged in user has the required role
    public function handle(Request $request, Closure $next, string $role)
    {
        // If not logged in redirect to login
        if (!Auth::check()) {
            return redirect('/login');
        }

        // Get the user's role name from role table
        $userRole = Auth::user()->role->name ?? null;

        // If role doesn't match redirect to products
        if ($userRole !== $role) {
            return redirect('/products')->with('error',
                'You do not have permission to access that page.');
        }

        return $next($request);
    }
}