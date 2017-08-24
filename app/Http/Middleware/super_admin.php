<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class super_admin
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
        if(Auth::user()->super_admin==0)
        {
            return redirect()->route('unauthorized');
        }
        return $next($request);
    }
}
