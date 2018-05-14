<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsCentralist
{

    public function handle($request, Closure $next)
    {
        if (Auth::user()->isCentralist()) {
            return $next($request);

        }

        return redirect('/error');
    }
}
