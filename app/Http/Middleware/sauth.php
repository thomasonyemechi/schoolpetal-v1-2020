<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class sauth
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
        if(session()->has('student_idx')){
            return $next($request);
        }
        return redirect('studentaccess')->with('error', "You Never Login");
    }
}
