<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
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
        if (auth()->check() && auth()->user()->type!='user')
        return $next($request);

        return redirect('/')->with('message','No cuentas con permisos suficientes para ingresar al panel');

    }
}
