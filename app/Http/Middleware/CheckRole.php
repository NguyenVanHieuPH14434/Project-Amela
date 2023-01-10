<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        $matchRole = ['admin', 'manager'];
        foreach($matchRole as $role){
            if(Auth::guard('web')->user()->user_role->contains('role_key', $role)){
                 return $next($request);
            }else{
                return redirect()->route('home1');
            }
        }
    }
}
