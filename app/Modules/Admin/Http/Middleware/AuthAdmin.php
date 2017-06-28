<?php

namespace App\Modules\Admin\Http\Middleware;

use Closure;
use function session;

class AuthAdmin
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
        $request->session()->put('xxx',2);
        return $next($request);
    }
}
