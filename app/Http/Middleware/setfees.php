<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class setfees
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
        if(auth()->user()->power->set_fees == 1){
            return $next($request);
        }
        return redirect('dashboard')->with('error', "You don't Have Permission To Set Fees");
    }
}
