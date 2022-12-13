<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class power
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->user()->power->power == 1){
            return $next($request);
        }
        return redirect('dashboard')->with('error', "You don't Have Permission");
    }
}
