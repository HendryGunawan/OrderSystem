<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class SuperAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(strtolower(Auth::user()->role->name) =='super admin')
        {
            return $next($request);
        }
        else
        {
            return redirect()->route('unauthorized');
        }
        
    }
}
