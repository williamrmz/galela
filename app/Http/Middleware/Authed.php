<?php

namespace App\Http\Middleware;

use Closure;

class Authed
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

        // dd(session('user'));

        // dd(url()->previous());

        if(!session()->has('user')){
            return redirect('/login');
        }

        return $next($request);
    }
}
