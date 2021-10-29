<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserLogin
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
        if (auth()->check()){
            if (auth()->user()->groupId!=2){
                Auth::logout();
                return redirect('login')->withMessage('!! Illegal access');
            }
        }else{
            return redirect('login')->withMessage('!! Do Login');
        }

        return $next($request);
    }
}
