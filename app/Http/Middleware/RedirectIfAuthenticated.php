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
    public function handle($request, Closure $next)
    {
        if (auth()->check()) {

            $user = Auth::user();
            if ($user->isAdmin()) {
                return redirect('/admin');
            }
            if ($user->isAmbulance()) {
                return redirect('/ambulance');
            }
            if ($user->isCentralist()) {
                return redirect('/centralist');
            }
        }
        return $next($request);
    }
}
