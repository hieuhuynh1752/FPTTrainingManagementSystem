<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class isTrainingStaff
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
        if(Auth::user()){
            if(Auth::user()->role==2){
                return $next($request);
            }
            elseif (Auth::user()->role==1){
                return redirect('admin');
            }
            elseif (Auth::user()->role==3){
                return redirect('trainer');
            }
            elseif (Auth::user()->role==4){
                return redirect('trainee');
            }
        }
        return redirect('login');
    }
}
