<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\Middleware\Session;

class CabangMiddleware
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
        if (Session::get('tipe') != "cabang") {
            return redirect('cabang/login');
        }else{
            return $next($request);
        }
    }
}
