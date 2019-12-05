<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class isTrainer
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
            if(Auth::user()->role==3){
                return $next($request);
            }
            elseif (Auth::user()->role==2){
                return redirect('trainingstaff');
            }
            elseif (Auth::user()->role==1){
                return redirect('admin');
            }
            elseif (Auth::user()->role==4){
                return redirect('trainee');
            }
        }
        return redirect('login');
    }
}
