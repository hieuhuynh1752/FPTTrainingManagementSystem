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
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            if(Auth::user()->role==1){
                return redirect('admin');
            }
            if(Auth::user()->role==2){
                return redirect('trainingstaff');
            }
            if(Auth::user()->role==3){
                return redirect('trainer');
            }
            if(Auth::user()->role==4){
                return redirect('trainee');
            }
            return redirect('/login');
        }

        return $next($request);
    }
}
