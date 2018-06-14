<?php

namespace App\Http\Middleware;

use Closure;
// use Auth;
 use Illuminate\Support\Facades\Auth;
//use Illuminate\Contracts\Routing\Middleware;

class IsAdmin
{

    public function handle($request, Closure $next)
    {
        if (Auth::user()->isAdmin())
        {
            return $next($request);

        }

        return redirect('/error');
    }
}