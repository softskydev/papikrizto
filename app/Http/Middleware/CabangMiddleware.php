<?php

namespace App\Http\Middleware;

use Closure;
use Session;

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
        if (Session::get('tipe') != "cabang" || Session::get('tipe') != "admin") {
            return redirect('cabang/');
        }else{
            return $next($request);
        }
    }
}
