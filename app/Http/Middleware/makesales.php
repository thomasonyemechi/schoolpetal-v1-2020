<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class makesales
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
        if(auth()->user()->power->make_sales == 1){
            return $next($request);
        }
        return redirect('dashboard')->with('error', "You don't Have Permission To Make Sales");
    }
}
