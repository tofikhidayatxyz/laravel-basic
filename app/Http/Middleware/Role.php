<?php

namespace App\Http\Middleware;

use Auth;

use Closure;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
        $roles = Auth::user()->authorizeRoles($roles);
        if($roles) {
            return $next($request);
        }
        return abort(401, 'Youare not authorize for this page');
        
    }
}
