<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Privilege
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if (auth()->guard('admin')->user()->$role == 1){
            return $next($request);
        }
        else{
            return redirect()->route('access.error');
        }
    }
}
