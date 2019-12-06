<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            if (auth('admin')->check())
            {
                return redirect('/admin');
            }elseif(auth('callcenter')->check())
            {
                return redirect('/call-centers');
            }elseif(auth('web')->check())
            {
                return redirect('/users');
            }
        }

        return $next($request);
    }
}
