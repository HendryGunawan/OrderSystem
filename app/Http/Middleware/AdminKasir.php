<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AdminKasir
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
        if(strtolower(Auth::user()->role->name) =='super admin' || strtolower(Auth::user()->role->name) =='admin kasir')
        {
            return $next($request);
        }
        else
        {
            return redirect()->route('unauthorized');
        }
        
    }
}
