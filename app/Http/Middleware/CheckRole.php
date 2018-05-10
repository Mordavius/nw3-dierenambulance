<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
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


        return $next($request);
    }
}


/*         if (! $request->user()->isAdmin()) {
            return redirect('/ambulance-meldingen')->with('message', 'Alleen toegangbaar voor centralisten');
        }
        else {
             redirect('/centralist-meldingen')->with('message', 'Alleen toegangbaar voor ambulance medewerkers');
        }
*/