<?php

namespace App\Http\Middleware;

use Closure;

class SignatureMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $headersName = 'X-Name')
    {
       $response = $next($request);

       $response->headers->set($headersName, config('app.name'));

       return $response;
    }
}
