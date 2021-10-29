<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Redirect;
use Illuminate\Support\Facades\Auth;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class checkLoginGroup extends Middleware
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
            if (auth()->user()->groupId!=1){
                Auth::logout();
                return redirect('login')->withMessage('!! Illegal access');
            }
        }else{
            return redirect('login')->withMessage('!! Do Login');
        }

        return $next($request);
    }
}
