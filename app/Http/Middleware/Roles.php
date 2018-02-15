<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class Roles
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect('login');
        }
        $user = $request->user();
        if (!$user->hasRole($role))
            return redirect('login');

        return $next($request);
    }
}
