<?php

namespace App\Http\Middleware;

use Closure;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role, $permission = null)
    {

        // if(!$request->user()->hasRole($role)) {
        if(!access()->hasRole($role)){
            abort(404);
        }
        if($permission !== null && !access()->allow($permission)) {
            abort(404);
        }

        return $next($request);
    }
}
