<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        // Not Logged
        if (!Auth::check()) {   
            return redirect('/login');
        }
        
        // Not allowed
        if (!str_contains($role, Auth::user()->userRole->first()->role)) {
            return abort(404);
        }
        return $next($request);
    }
}
