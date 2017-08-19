<?php
namespace App\Http\Middleware;

use Closure;

class AlwaysExpectsJson
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $request->headers->add(['Accept' => 'application/json']);

        return $next($request);
    }
}