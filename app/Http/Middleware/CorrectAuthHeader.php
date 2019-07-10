<?php

namespace App\Http\Middleware;

use Closure;

class CorrectAuthHeader
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
        if ($request->headers->has('X-Auth-Bearer')) {
        	$request->headers->set('Authorization', 'Bearer '.$request->headers->get('X-Auth-Bearer'));
        }

    	return $next($request);
    }
}
