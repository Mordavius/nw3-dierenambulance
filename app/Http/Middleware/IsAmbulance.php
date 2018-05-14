<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsAmbulance
{

    public function handle($request, Closure $next)
    {
        if (Auth::user()->isAmbulance())
        {
            return $next($request);

        }

        return redirect('/error');
    }
}
