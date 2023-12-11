<?php

namespace App\Http\Middleware;

use Closure;
use DB;
use Log;
use Auth;

class mdwPerdeuLogin
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
        if (!session()->has('user_id') || session()->isExpired()) {
            return redirect()->route('login');
        }
    
        return $next($request);
    }

}
